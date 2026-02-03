<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Language;
use App\Models\Event;
use App\Models\EventRate;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    public function dashboard()
    {

        // cache $teachers for 60 minutes
        /*$teachers = cache()->remember('teachers', 60, function () {
            return Teacher::orderByRaw("
                CASE 
                    WHEN image IS NULL OR image = '' THEN 1 
                    ELSE 0 
                END
            ")->where('status', 1)->get();
        });*/



        // $where = // where start >= now
        // $lessons = Event::where('is_free', 1)->where('end', '>=', now())->with('teacher')->orderBy('start')->get();

        $lessons = Event::with('teacher')->where(['is_free' => 1, 'grade' => auth()->user()->grade])->where('end', '>=', now())->orderBy('start')->get();


        $grades = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13'];

        // group lessons by grade
       $groupedLessons = [];
        foreach ($grades as $grade) {
            foreach($lessons as $lesson){
                if($lesson->grade == $grade){
                    $groupedLessons[$grade][] = $lesson;

                }
            }
        }

        //dd($groupedLessons);



        $paidLessons = Event::where('is_free', false)->where('grade', auth()->user()->grade)->with('teacher')->orderBy('start')->get();

        $myLessons = [];
        foreach ($lessons as $lesson) {
            $attendees = $lesson->attendees ? explode(',', $lesson->attendees) : [];
            if (in_array(auth('student')->user()->id, $attendees)) {
                $myLessons[] = $lesson;
            }
        }

        //dd($paidLessons);

        //dd($myLessons);

        //$paidLessons = Event::where('is_free', false)->with('teacher')->get();
        //dd($freeLessons);
        return view('student.dashboard', compact('lessons', 'myLessons', 'paidLessons', 'groupedLessons'));
    }

    public function dashboard2()
    {
        // cache $teachers for 60 minutes
        /*$teachers = cache()->remember('teachers', 60, function () {
            return Teacher::orderByRaw("
                CASE 
                    WHEN image IS NULL OR image = '' THEN 1 
                    ELSE 0 
                END
            ")->where('status', 1)->get();
        });*/



        // $where = // where start >= now
        //$lessons = Event::where('is_free', 1)->where('end', '>=', now())->with('teacher')->orderBy('start')->get();

        $lessons = Event::with('teacher')->where(['is_free' => 1])->where('end', '>=', now())->orderBy('start')->get();


        $grades = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13'];

        // group lessons by grade
       $groupedLessons = [];
        foreach ($grades as $grade) {
            foreach($lessons as $lesson){
                if($lesson->grade == $grade){
                    $groupedLessons[$grade][] = $lesson;

                }
            }
        }

        //dd($groupedLessons);



        $paidLessons = Event::where('is_free', false)->with('teacher')->orderBy('start')->get();

        $myLessons = [];
        foreach ($lessons as $lesson) {
            $attendees = $lesson->attendees ? explode(',', $lesson->attendees) : [];
            if (in_array(auth('student')->user()->id, $attendees)) {
                $myLessons[] = $lesson;
            }
        }

        //dd($paidLessons);

        //$paidLessons = Event::where('is_free', false)->with('teacher')->get();
        //dd($freeLessons);
        return view('student.dashboard', compact( 'lessons', 'myLessons', 'paidLessons', 'groupedLessons'));
    }

    public function joinToEvent($id)
    {
        $event = Event::findOrFail($id);
        $max_person = $event->max_person;
        $attendees_count = $event->attendees ? count(explode(',', $event->attendees)) : 0;
        
        $student_id = auth('student')->user()->id;
        $attendees = $event->attendees ? explode(',', $event->attendees) : [];
        if(in_array($student_id, $attendees)) {
            // Student already joined
            echo json_encode(['status' => 'already_joined', 'message' => 'You have already joined this event.']);
            return;
        }

        if($attendees_count >= $max_person) {
            echo json_encode(['status' => 'full', 'message' => 'This event is full.']);
            return;
        }
        $attendees[] = $student_id;
        $event->attendees = implode(',', $attendees);
        $event->save();

        echo json_encode(['status' => 'success', 'message' => 'You have joined the event successfully.']);
        return;
    }

    public function oldEvents(){
        $events = Event::where('is_free', 1)->where('end', '<', now())->with('teacher')->orderBy('start')->get();
        $studentId = auth('student')->user()->id;
        $joined_events = [];
        foreach($events as $event){
            $event->attendees = explode(',', $event->attendees);
            $event->is_joined = in_array($studentId, $event->attendees);
            if($event->is_joined){
                $joined_events[] = $event;
            }
        }


        $myEventRates = EventRate::where('student_id', $studentId)->get(); 
        $rated_lessons = [];
        foreach($joined_events as $key => $event){
            foreach($myEventRates as $rate){
                if($rate->event_id == $event->id){
                    unset($joined_events[$key]);
                    $rated_lessons[] = $event;
                }
            }
        }

        //dd($joined_events);


        
        return view('student.old_events', compact('joined_events'));
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

    
}
