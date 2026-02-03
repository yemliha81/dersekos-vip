<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Language; // Assuming you have a Language model to fetch languages

class GradeController extends Controller
{

    public function index()
    {
        // code to list all grades where lang is en
        $grades = Grade::where('lang', 'tr')->get();
        $languages = Language::all(); // Assuming you have a Language model to fetch languages
        return view('admin.grade.index', compact('grades', 'languages'));
    }

    public function create()
    {
        // code to show create grade form
        $languages = Language::all();
        return view('admin.grade.create', compact('languages'));
    }

    public function store(Request $request)
    {
        // code to store new grade

        //dd($request->all());

        if ($request->has('grade_id')) {
                $grade_id = $request->grade_id; // Use the provided grade_id
            }else{
                $grade_id = Grade::max('grade_id') + 1; // Increment the maximum grade_id by 1
                if (!$grade_id) {
                    $grade_id = 1; // If no grade items exist, start with 1
                }
            }
        try {

             $languages = Language::all();
            
            //validation
            foreach ($languages as $language) {
                if($language->lang_code == 'tr'){
                    
                    $request->validate([
                        'title_' . $language->lang_code => 'required|max:100',
                        'seo_url_' . $language->lang_code => 'required|max:255',
                        'description_' . $language->lang_code => 'required',
                        'seo_title_' . $language->lang_code => 'nullable|max:255',
                        'seo_description_' . $language->lang_code => 'nullable|max:255',
                        'seo_keywords_' . $language->lang_code => 'nullable|max:255',
                    ]);

                }

                // save image if it exists
                if ($request->hasFile('image_tr') || $request->hasFile('image_' . $language->lang_code)) {
                    $tmpImgPath = createTmpFile($request, 'image_tr', $languages[0]);
                    $imageName = moveFile($request,$language,'image_' . $language->lang_code, 'image_tr', 'alt_' . $language->lang_code, 'alt_en', $language->images_folder, $tmpImgPath);
                    //dd($imageName);
                }else{
                    $imageName = $request->input('old_image_' . $language->lang_code, null); // Use old image if no new image is uploaded
                }

                Grade::updateOrCreate(
                    ['grade_id' => $grade_id, 'lang' => $language->lang_code],
                    [
                        'name' => $request->input('title_' . $language->lang_code) ?? $request->input('title_en'),
                        'description' => $request->input('description_' . $language->lang_code) ?? $request->input('description_en'),
                        'seo_url' => $request->input('seo_url_' . $language->lang_code) ?? $request->input('seo_url_en'),
                        'seo_title' => $request->input('seo_title_' . $language->lang_code) ?? $request->input('seo_title_en'),
                        'seo_description' => $request->input('seo_description_' . $language->lang_code) ?? $request->input('seo_description_en'),
                        'seo_keywords' => $request->input('seo_keywords_' . $language->lang_code) ?? $request->input('seo_keywords_en'),
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                );

            }



            return redirect()->route('admin.grade')->with('success', 'Grade başarıyla kaydedildi.');
        } catch (\Exception $e) {
            throw $e;
           //return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // code to show edit grade form
        $grades = Grade::where('grade_id', $id)->get();
        //dd($grades);
        $languages = Language::all();
        
        return view('admin.grade.edit', compact('grades', 'languages'));
    }

    public function destroy($id)
    {
        // code to delete grade
        Grade::where('grade_id', $id)->delete();
        GradeSlider::where('grade_id', $id)->delete();
        return redirect()->route('admin.grade')->with('success', 'Grade başarıyla silindi.');
    }

    public function lessons($id)
    {
        // code to list all lessons for a specific grade
        $grade = Grade::where('grade_id', $id)->where('lang', 'tr')->with('lessons')->first();
        if (!$grade) {
            return redirect()->route('admin.grade')->withErrors(['error' => 'Sınıf bulunamadı.']);
        }
        $lessons = $grade->lessons; // Using the relationship defined in the Grade model

        //dd($grade);
        return view('admin.lesson.index', compact('lessons', 'grade'));
    }   

}
