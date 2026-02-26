<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Currency;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\RetrieveCheckoutFormRequest;
use Iyzipay\Model\CheckoutForm;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use App\Models\Student;
use App\Models\ParentOrder;
// DB Facade
use DB;
// use log
use Log;

class IyzicoController extends Controller
{
    

    public function pay()
    {
        $student = Student::find(auth()->guard('student')->user()->id)->with('studentParent')->first();

        //dd(session());
        // get session_id
        $sessionId = session()->getId();
        //dd($sessionId);

        $cartItems = session()->get('cart', []); 
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'];
        }

        if($student->studentParent){
        $orderId = md5('00' . $student->id . date('Y-m-d H:i'));

        session(['basket_id' => $orderId]);

        // insert data into parent_order_table, student_id, parent_id, cart_data, payment_data, total_price with DB facade
        //dd($sessionId);
        ParentOrder::updateOrCreate(
        ['order_id' => $orderId, 'student_id' => $student->id],
        [
            'session_id' =>  $sessionId,
            'parent_id' => $student->studentParent->id,
            'cart_data' => json_encode($cartItems),
            'payment_data' => '-',
            'total_price' => $totalPrice,
        ]);

        $options = new Options();

        if(env('IYZICO_MODE') == "test"){

            $options->setApiKey(config('iyzico.sandbox_api_key'));
            $options->setSecretKey(config('iyzico.sandbox_secret_key'));
            $options->setBaseUrl(config('iyzico.sandbox_base_url'));

        }

        if(env('IYZICO_MODE') == "live"){

            $options->setApiKey(config('iyzico.api_key'));
            $options->setSecretKey(config('iyzico.secret_key'));
            $options->setBaseUrl(config('iyzico.base_url'));

        }
        

        $request = new CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId($orderId);
        $request->setPrice($this->decimalPrice($totalPrice));
        $request->setPaidPrice($this->decimalPrice($totalPrice));
        $request->setCallbackUrl(route('iyzico.callback'));
        //$request->setPaymentSuccessUrl(route('iyzico.success'));
        //$request->setPaymentFailureUrl(route('iyzico.failure'));
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId($orderId);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);


        $buyerId = "BY00".$student->studentParent->id;
        $buyer = new Buyer();
        $buyer->setId($buyerId);
        $buyer->setName($student->studentParent->first_name);
        $buyer->setSurname($student->studentParent->last_name);
        $buyer->setGsmNumber($student->studentParent->phone);
        $buyer->setEmail($student->studentParent->email);
        $buyer->setIdentityNumber($student->studentParent->tc_no);
        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($student->studentParent->address);
        $buyer->setIp(request()->ip());
        $buyer->setCity($student->studentParent->city);
        $buyer->setCountry("Turkey");
        $buyer->setZipCode($student->studentParent->zipcode ?? null);

        $request->setBuyer($buyer);

        $billingAddress = new Address();
        $billingAddress->setContactName($student->studentParent->first_name . " " . $student->studentParent->last_name);
        $billingAddress->setCity($student->studentParent->city);
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress($student->studentParent->address);
        $billingAddress->setZipCode($student->studentParent->zipcode ?? null);

        $request->setBillingAddress($billingAddress);

        $basketItems = [];

        foreach ($cartItems as $item) {
            $basketItem = new BasketItem();
            $basketItem->setId($item['id']);
            $basketItem->setName($item['name']);
            $basketItem->setCategory1("Genel");
            $basketItem->setItemType(BasketItemType::VIRTUAL);
            $basketItem->setPrice($this->decimalPrice($item['price']));
            $basketItems[] = $basketItem;
        }

        $request->setBasketItems($basketItems);
        // ... request ayarları

        $checkoutForm = CheckoutFormInitialize::create($request, $options);

            //dd($checkoutForm);

            return view('cart.payment', compact('checkoutForm', 'student'));

        }else{
            
            $checkoutForm = null;
            return view('cart.payment', compact( 'student'));
        }

        //dd($checkoutForm);

        
    }

    public function decimalPrice($price)
    {
        return number_format($price, 2, '.', '');
    }
    

    public function callback(Request $request)
    {
        
        $options = new Options();
        if(env('IYZICO_MODE') == "test"){

            $options->setApiKey(config('iyzico.sandbox_api_key'));
            $options->setSecretKey(config('iyzico.sandbox_secret_key'));
            $options->setBaseUrl(config('iyzico.sandbox_base_url'));

        }

        if(env('IYZICO_MODE') == "live"){

            $options->setApiKey(config('iyzico.api_key'));
            $options->setSecretKey(config('iyzico.secret_key'));
            $options->setBaseUrl(config('iyzico.base_url'));

        }

        $retrieveRequest = new RetrieveCheckoutFormRequest();
        $retrieveRequest->setToken($request->token);

        $checkoutForm = CheckoutForm::retrieve($retrieveRequest, $options);

        if ($checkoutForm->getPaymentStatus() === "SUCCESS") {


            try {
                // ödeme başarılı
                //dd($checkoutForm);

                $basketId = $checkoutForm->getBasketId();
                $rawResult = $checkoutForm->getRawResult();

                //Find ParenOrder with order_id = basketId
                $parentOrder = ParentOrder::where('order_id', $basketId)->first();
                $parentOrder->is_paid = 1;
                $parentOrder->payment_data = $rawResult;
                $parentOrder->save();

                $sessionId = $parentOrder->session_id;

                    

                if ($sessionId) {
                    //Start session with $sessionId
                    session()->start($sessionId);
                    // Artık Auth::user() çalışacaktır

                    //dd(session()->all());
                    

                    session()->forget('cart');

                    return redirect()->route('student.iyzico.success')->with('success', 'Ödeme başarılı');
                }
                
                

                
                //return response()->json(['status' => 'ok'], 200);



            } catch (\Throwable $th) {

            throw $th;
            die();

                // if DB save fails save data into log file
                $log = new Log();
                $payment = json_decode($checkoutForm->getRawResult());

                $cartItems = session()->get('cart', []); 
                $totalPrice = 0;
                foreach ($cartItems as $item) {
                    $totalPrice += $item['price'];
                }

                $student = auth('student')->user();

                $log->student_id = $student->id;
                $log->parent_id = $student->studentParent->id;
                $log->cart_data = json_encode($cartItems);
                $log->payment_data = json_encode($payment);
                $log->total_price = $totalPrice;
                $log->message = $th->getMessage();
                $log->save();


                //throw $th;
            }

            

            //
            
        } else {
            // ödeme başarısız
            dd($checkoutForm);
        }
    }

    



}
