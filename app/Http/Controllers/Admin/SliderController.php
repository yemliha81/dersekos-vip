<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Language; // Assuming you have a Language model to fetch languages

class SliderController extends Controller
{

    public function index()
    {
        // code to list all sliders where lang is en
        $sliders = Slider::where('lang', 'tr')->get();
        $languages = Language::all(); // Assuming you have a Language model to fetch languages
        return view('admin.slider.index', compact('sliders', 'languages'));
    }

    public function create()
    {
        // code to show create slider form
        $languages = Language::all();
        return view('admin.slider.create', compact('languages'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        if ($request->has('slider_id')) {
            $slider_id = $request->slider_id; // Use the provided slider_id
        }else{
            $slider_id = Slider::max('slider_id') + 1; // Increment the maximum slider_id by 1
            if (!$slider_id) {
                $slider_id = 1; // If no slider items exist, start with 1
            }
        }

        try {

            $languages = Language::all();
            
            //validation
            foreach ($languages as $language) {
                if($language->lang_code == 'tr'){
                    $request->validate([
                        'slide_title_' . $language->lang_code => 'required|max:400',
                        'title_' . $language->lang_code => 'required|max:400',
                        'title_1_' . $language->lang_code => 'nullable|max:400',
                        'title_2_' . $language->lang_code => 'nullable|max:400',
                        'button_title_' . $language->lang_code => 'required|max:400',
                        'url_' . $language->lang_code => 'required|max:255',
                        'image_' . $language->lang_code => 'nullable|image|max:2048', // Assuming image is optional
                        'alt_' . $language->lang_code => 'required|max:255',
                    ]);
                }
                if ($request->hasFile('image_tr') || $request->hasFile('image_' . $language->lang_code)) {
                    $tmpImgPath = createTmpFile($request, 'image_tr', $languages[0]);
                    $imageName = moveFile($request,$language,'image_' . $language->lang_code, 'image_tr', 'alt_' . $language->lang_code, 'alt_en', $language->images_folder, $tmpImgPath);
                    //dd($imageName);
                }else{
                    $imageName = $request->input('old_image_' . $language->lang_code, null); // Use old image if no new image is uploaded
                }

                Slider::updateOrCreate(
                    ['slider_id' => $slider_id, 'lang' => $request->input('lang_' . $language->lang_code)],
                    [
                        'slide_title' => $request->input('slide_title_' . $language->lang_code) ?? $request->input('slide_title_en'),
                        'title' => $request->input('title_' . $language->lang_code) ?? $request->input('title_en'),
                        'title_1' => $request->input('title_1_' . $language->lang_code) ?? $request->input('title_1_en'),
                        'title_2' => $request->input('title_2_' . $language->lang_code) ?? $request->input('title_2_en'),
                        'button_title' => $request->input('button_title_' . $language->lang_code) ?? $request->input('button_title_en'),
                        'url' => $request->input('url_' . $language->lang_code) ?? $request->input('url_en'),
                        'image' => $imageName,
                        'alt' => $request->input('alt_' . $language->lang_code) ?? $request->input('alt_en'),
                        'sort' => $request->input('sort_' . $language->lang_code) ?? 0,
                    ]
                );

            }

            return redirect()->route('admin.slider.index')->with('success', 'Slider başarıyla kaydedildi.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // code to show edit slider form
        $sliders = Slider::where('slider_id', $id)->get();
        //dd($sliders);
        $languages = Language::all();

        return view('admin.slider.edit', compact('sliders', 'languages'));
    }

    public function destroy($id)
    {
        // code to delete blog
        Slider::where('slider_id', $id)->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider başarıyla silindi.');
    }

   

}
