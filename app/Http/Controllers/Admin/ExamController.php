<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\ExamQuestion;


class ExamController extends Controller
{

    public function index(){

        $exams = Exam::all();

        return view('admin.exam.index', compact('exams'));
    }

    // create method
    public function create(){
        return view('admin.exam.create');
    }

    // store method
    public function store(Request $request){    
        
        if($request->has('id')){
            $exam = Exam::find($request->id);
        }else{
            $exam = new Exam();
        }
        $exam->title = $request->title;
        $exam->subtitle = $request->subtitle;
        $exam->save();

        return redirect()->route('admin.exam.index')->with('success', 'Sınav başarıyla oluşturuldu.');
    }

    // edit method
    public function edit($id){
        $exam = Exam::find($id);
        return view('admin.exam.edit', compact('exam'));        
    }

    // questions list method
    public function questionIndex(Request $request, $exam_id){
        
        $questions = ExamQuestion::where('exam_id', $exam_id)->get();
        return view('admin.exam.question.index', compact('questions', 'exam_id'));
    }


    // questionCreate method
    public function questionCreate($exam_id){
        $exam = Exam::find($exam_id);
        return view('admin.exam.question.create', compact('exam'));
    }

    // questionStore method
    public function questionStore(Request $request)
    {
        // code to store new page

        //dd($request->all());

        if ($request->has('id')) {
                $id = $request->id; // Use the provided id
            }else{
                $id = null; // Set id to null for new record
            }
        try {


                $request->validate([
                    'exam_id' => 'required|exists:exam_table,id',
                    'branch' => 'required|max:100',
                    'answer' => 'required|max:1',
                    'question_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                // save image if it exists
                if ($request->hasFile('question_image') ) {
                    
                    //save question_image to public/assets/img/exam_questions/ if the folder does not exist, create it
                    $image = $request->file('question_image');
                    //get image extension
                    $imageExtension = $image->getClientOriginalExtension();
                    $imageName = $request->input('branch') . '_' . uniqid() . '.' . $imageExtension;
                    $image->move(public_path('assets/img/exam_questions/'), $imageName);
                    //dd($imageName);
                }

                ExamQuestion::updateOrCreate(
                    ['id' => $id],
                    [
                        'exam_id' => $request->input('exam_id'),
                        'branch' => $request->input('branch'),
                        'answer' => $request->input('answer'),
                        'question_image' => $imageName,
                    ]
                );

            // redirect to exam question list with success message with exam_id parameter
            return redirect()->route('admin.exam.question.index', ['exam_id' => $request->input('exam_id')])->with('success', 'Sınav sorusu başarıyla kaydedildi.');


            
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
    }


}