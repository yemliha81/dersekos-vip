<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Language;
use App\Models\Event;
use App\Models\EventRate;
use App\Models\Quiz;
use App\Models\StudentParent;
use App\Models\Student;
use App\Models\ParentOrder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    public function dashboard()
    {
        $orders = Order::where('student_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('student.dashboard', compact('orders'));
    }

    public function rateEvent(Request $request){
        
        try {
            //dd($request->all());
            $event = Event::findOrFail($request->event_id);
            
                $eventRate = EventRate::create([
                    'event_id' => $request->event_id,
                    'teacher_id' => $event->teacher_id,
                    'student_id' => auth('student')->user()->id,
                    'rating' => $request->rate,
                    'comment' => $request->comment ?? null
                ]);
            
            return back()->with('success', 'Yorum ve puan başarıyla kaydedildi.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Lütfen gerekli alanları eksiksiz doldurun.');
        }

        

    }

    public function saveParent(Request $request){
        try {
            //dd($request->all());
            $student = Student::findOrFail(auth('student')->user()->id);

            $parent = StudentParent::where('student_id', $student->id)->first();

            if($parent){
                $parent->id = $parent->id;
                $parent->student_id = $student->id;
                $parent->first_name = $request->first_name;
                $parent->last_name = $request->last_name;
                $parent->tc_no = $request->tc_no ?? null;
                $parent->email = $request->email;
                $parent->phone = $request->phone;
                $parent->address = $request->address;
                $parent->city = $request->city;
                $parent->town = $request->town;
                $parent->zipcode = $request->zipcode ?? null;
                $parent->save();
            }else{
                $parent = StudentParent::create([
                    'student_id' => $student->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'tc_no' => $request->tc_no ?? null,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'town' => $request->town,
                    'zipcode' => $request->zipcode ?? null
                ]);
            }

            
            return back()->with('success', 'Veli bilgisi başarıyla kaydedildi.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function paymentSuccess(){
        $basketId = session('basket_id');

        //Find ParentOrder
        $parentOrder = ParentOrder::where('order_id', $basketId)->first();



        return view('student.payment_success', compact('parentOrder'));
    }

    public function paymentFailure(){
        return view('student.payment_failure');
    }

    
}
