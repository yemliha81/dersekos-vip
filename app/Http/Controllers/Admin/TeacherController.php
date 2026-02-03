<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;


class TeacherController extends Controller
{
   
    public function teacherShow($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {
            //code...
        $teacher = Teacher::findOrFail($request->teacher_id);
        $teacher->name = $request->input('name');
        $teacher->branch = $request->input('branch');
        
        $teacher->experience = $request->input('experience');
        $teacher->phone = $request->input('phone');
        $teacher->certificates = $request->input('certificates');
        $teacher->tags = $request->input('tags');
        $teacher->about = $request->input('about');
        $teacher->status = $request->input('status');
        //status
        

        if($request->has('image')){

            $imagePath = $request->file('image')->move(public_path('teacher_images'), uniqid().'.jpg');
            $teacher->image = 'teacher_images/' . basename($imagePath);

        }
        
        
        // create or update event
        $teacher->save();



        return redirect()->back()->with('success', 'Eğitmen başarıyla güncellendi.');
        
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function delete($id)
    {
        try {
            //code...
            Teacher::where('id', $id)->delete();
            return redirect()->route('admin.teachers')->with('success', 'Eğitmen basarıyla silindi.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}