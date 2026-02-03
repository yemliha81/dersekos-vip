<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\ExamQuestion;
use App\Models\Student;


class ExamController extends Controller
{

    public function index($id){

        $exam = Exam::find($id);
        $examQuestions = ExamQuestion::where('exam_id', $id);

        return view('exam.index', compact('exam', 'examQuestions'));
    }


    // submit exam answers
    public function submitAnswers(Request $request, $exam_id){

        $examStudent = new ExamStudent();
        $examStudent->exam_id = $exam_id;
        $examStudent->student_id = $request->student_id;
        $examStudent->answers = $request->answers;
        $examStudent->save();        

        return response()->json(['message' => 'Answers submitted successfully']);
    }



}