<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;


class EventsController extends Controller
{
    public function events()
    {
        $events = Event::all();
        return view('admin.dashboard.events', compact('events'));
    }

    public function eventShow($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.dashboard.event_show', compact('event'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {
            //code...
        
        $event = Event::findOrFail($request->event_id);
        $event->id = $request->event_id;
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->grade = $request->grade;
        $event->min_person = $request->min_person;
        $event->max_person = $request->max_person;
        $event->is_free = $request->is_free;
        $event->price = $request->is_free == 1 ? null : $request->price;
        $event->meet_url = $request->meet_url;
        $event->attendees = $request->attendees;
        
        // create or update event
        $event->save();



        return redirect()->back()->with('success', 'Etkinlik başarıyla güncellendi.');
        
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}