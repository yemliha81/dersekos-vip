<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;


class DashboardController extends Controller
{
    public function dashboard()
    {
        
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $freeEventCount = Event::where('is_free', 1)->count();
        $paidEventCount = Event::where('is_free', 0)->count();

        $teacherCountsByDay = Teacher::all()
        ->groupBy(fn ($teacher) => $teacher->created_at->format('Y-m-d'))
        ->map(fn ($items) => $items->count());

        $studentCountsByDay = Student::all()
        ->groupBy(fn ($student) => $student->created_at->format('Y-m-d'))
        ->map(fn ($items) => $items->count());

        //dd($teacherCountsByDay);


        return view('admin.dashboard', compact('studentCount', 'teacherCount', 'freeEventCount', 'paidEventCount', 'teacherCountsByDay', 'studentCountsByDay'));
    }

    public function students()
    {
        $students = Student::all();
        return view('admin.dashboard.students', compact('students'));
    }
    public function studentShow($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.dashboard.student_show', compact('student'));
    }


    public function teachers()
    {
        $teachers = Teacher::all();

        $countsByDay = Teacher::all()
        ->groupBy(fn ($teacher) => $teacher->created_at->format('Y-m-d'))
        ->map(fn ($items) => $items->count());


        return view('admin.dashboard.teachers', compact('teachers'));

        }
        

    public function teacherShow($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.dashboard.teacher_show', compact('teacher'));
    }

    public function events($type)
    {
        $is_free = ($type === 'free') ? 1 : 0;
        $events = Event::where('is_free', $is_free)->orderBy('start')->with('teacher')->get();
        return view('admin.dashboard.events', compact('events'));
    }

    public function eventShow($id)
    {
        $event = Event::with('teacher')->findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }
}