<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Language; // Assuming you have a Language model to fetch languages

class QuizController extends Controller
{

    public function index()
    {
        // code to list all quizs where lang is en
        $quizes = Quiz::all();
        return view('admin.quiz.index', compact('quizes'));
    }

    public function create()
    {
        // code to show create quiz form
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $id = $request->input('id');

        try {
                
                $request->validate([
                    'title' => 'required|max:400',
                    'subtitle' => 'required|max:400',
                    'json_data' => 'required|string',
                ]);
                
                

                Quiz::updateOrCreate(
                    ['id' => $id],
                    [
                        'title' => $request->input('title'),
                        'subtitle' => $request->input('subtitle'),
                        'json_data' => $request->input('json_data'),
                        'sort' => $request->input('sort')??0,
                    ]
                );

            

            return redirect()->route('admin.quiz.index')->with('success', 'Quiz başarıyla kaydedildi.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // code to show edit quiz form
        $quiz = Quiz::where('id', $id)->first();
        //dd($quizs);

        //dd($quiz);

        return view('admin.quiz.edit', compact('quiz'));
    }

    public function destroy($id)
    {
        // code to delete blog
        Quiz::where('quiz_id', $id)->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz başarıyla silindi.');
    }

   

}
