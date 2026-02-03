<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Language;
use App\Models\Event;
use App\Models\EventRate;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;


class QuizController extends Controller
{
    public function quiz_list()
    {

        // cache $teachers for 60 minutes
        $quiz_list = cache()->remember('quiz_list', 60, function () {
            return Quiz::all();
        });


        //dd($myLessons);

        //$paidLessons = Event::where('is_free', false)->with('teacher')->get();
        //dd($freeLessons);
        return view('quiz.list', compact('quiz_list'));
    }

    public function quiz_show($id)
    {
        $quiz = Quiz::where('id', $id)->first();

        $type = $quiz->sort;

        if($type == 2){
            return view('quiz.quiz2', compact('quiz'));
        }else{
            return view('quiz.quiz1', compact('quiz'));
        }

        
    }
    
}
