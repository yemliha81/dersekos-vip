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

class IyzicoController extends Controller
{
    

    public function pay()
    {
        $student = Student::find(auth()->guard('student')->user()->id)->with('studentParent')->first();

        //dd($student);

        if($student->studentParent){

            $cartItems = session()->get('cart', []); 
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item['price'];
            }
        
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
            $request->setLocale(Locale::TR);
            $request->setConversationId(uniqid());
            $request->setPrice($totalPrice);
            $request->setPaidPrice($totalPrice);
            $request->setCurrency(Currency::TL);
            $request->setPaymentGroup(PaymentGroup::PRODUCT);
            $request->setCallbackUrl(route('iyzico.callback'));

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
                $basketItem->setPrice($item['price']);
                $basketItems[] = $basketItem;
            }

            $request->setBasketItems($basketItems);

            $checkoutForm = CheckoutFormInitialize::create($request, $options);

            //dd($checkoutForm);

            return view('cart.payment', compact('checkoutForm', 'student'));

        }else{
            $checkoutForm = null;
            return view('cart.payment', compact( 'student'));
        }

        //dd($checkoutForm);

        
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
            // ödeme başarılı
            $payment = json_decode($checkoutForm->getRawResult());

            //
            
        } else {
            // ödeme başarısız
            dd($checkoutForm);
        }
    }
}
