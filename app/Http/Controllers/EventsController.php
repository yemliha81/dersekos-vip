<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;
use Carbon\Carbon;


class EventsController extends Controller
{

    public function index(){
        $teacherId = auth('teacher')->user()->id;

        return Event::where('teacher_id', $teacherId)->get();
    }

    public function paidEvents(){
        $now = Carbon::now();
        $events = Event::where('is_free', '0')
            ->where('start', '>', $now)
            ->with('teacher')
            ->get();
        return $events;
    }

    public function allEvents(){


        // where start is greater than today and is_free is 1
        $now = Carbon::now();
        $events = Event::where('is_free', '1')
            ->where('start', '>', $now)
            ->with('teacher')
            ->get();

        return $events;
    }

    public function store (Request $request) {
        //dd($request->all());
        $teacherId = auth('teacher')->user()->id;


         //check if end time is after start time
        if(Carbon::parse($request->end)->lessThanOrEqualTo(Carbon::parse($request->start))){
            return response()->json([
                'error' => 'Ders bitiş zamanı, başlangıç zamanından önce veya aynı olamaz.'
            ], 400);
        }

        // check if the event time is less than 30 minutes
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $diffInMinutes = $start->diffInMinutes($end);
        if($diffInMinutes < 30){
            return response()->json([
                'error' => 'Ders süresi en az 30 dakika olmalıdır.'
            ], 400);
        }

        // check if the event total time is more than 45 minutes
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $diffInMinutes = $start->diffInMinutes($end);

        if($diffInMinutes > 45){
            return response()->json([
                'error' => 'Ders süresi 45 dakikadan fazla olamaz.'
            ], 400);
        }


        // check if event start time is in the past
        if($start->isPast()){
            return response()->json([
                'error' => 'Ders başlangıç zamanı geçmiş bir tarih olamaz.'
            ], 400);
        }

        // list events with same grade and time
        if($request->is_free == 1){
        
            $existing_free_events = Event::where('grade', $request->grade)
                ->where('is_free', '1')
                ->where('start', Carbon::parse($request->start))
                ->where(function($query) use ($request) {
                    $query->whereBetween('start', [Carbon::parse($request->start), Carbon::parse($request->end)])
                        ->orWhereBetween('end', [Carbon::parse($request->start), Carbon::parse($request->end)]);
                })
                ->get();
            if($existing_free_events->count() > 0 && $request->is_free == '1'){
                return response()->json([
                    'error' => 'Girdiğiniz zaman diliminde aynı sınıf seviyesi için ücretsiz başka bir ders bulunuyor. Lütfen farklı bir zaman dilimi seçin.'
                ], 400);

            }

        }

        //dd($existing_free_events);

        $event = Event::updateOrCreate(
            ['id'         => $request->event_id],
            [
            'title'      => $request->title,
            'grade'      => $request->grade,
            'start'      => Carbon::parse($request->start)->format('Y-m-d H:i:s'),
            'end'        => Carbon::parse($request->end)->format('Y-m-d H:i:s'),
            'meet_url'   => $request->meet_url,
            'is_free'    => $request->is_free,
            'price'      => $request->price,
            'min_person' => $request->min_person,
            'max_person' => $request->max_person,
            'teacher_id' => $teacherId,
        ]);

        return response()->json($event);
    }

    public function update (Request $request) {
        //dd($request->all());
        

        try {

        $teacherId = auth('teacher')->user()->id;


        //check if end time is after start time
        if(Carbon::parse($request->end)->lessThanOrEqualTo(Carbon::parse($request->start))){
            return back()->with('error', 'Ders bitiş zamanı, başlangıç zamanından önce veya aynı olamaz.');
        }

        // check if the event time is less than 30 minutes
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $diffInMinutes = $start->diffInMinutes($end);
        if($diffInMinutes < 30){
            return back()->with('error', 'Ders süresi en az 30 dakika olmalıdır.');
        }

        // check if the event total time is more than 45 minutes
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $diffInMinutes = $start->diffInMinutes($end);

        if($diffInMinutes > 45){
            return back()->with('error', 'Etkinlik süresi 45 dakikadan fazla olamaz.');
        }


        // check if event start time is in the past
        if($start->isPast()){
            return back()->with('error', 'Ders başlangıç zamanı geçmiş bir tarih olamaz.');
        }


        // check if meetUrl contains https:// and (meet.google.com or zoom.us)
        if(!str_starts_with($request->meet_url, 'https://') || (!str_contains($request->meet_url, 'meet.google.com') && !str_contains($request->meet_url, 'zoom.us'))){
            return back()->with('error', 'Lütfen geçerli bir toplantı linki girin (Google Meet veya Zoom).');
        }

        //check if meetUrl is a valid URL 
        if(!filter_var($request->meet_url, FILTER_VALIDATE_URL)){
            return back()->with('error', 'Lütfen geçerli bir toplantı linki girin. (Google Meet veya Zoom)');
        }
        
        $event = Event::updateOrCreate(
            ['id'         => $request->event_id],
            [
            'title'      => $request->title,
            'grade'      => $request->grade,
            'start'      => Carbon::parse($request->start)->format('Y-m-d H:i:s'),
            'end'        => Carbon::parse($request->end)->format('Y-m-d H:i:s'),
            'meet_url'   => $request->meet_url,
            'price'      => $request->price,
            'min_person' => $request->min_person,
            'max_person' => $request->max_person,
            'teacher_id' => $teacherId,
        ]);

            return back()->with('success', 'Etkinlik başarıyla güncellendi.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}