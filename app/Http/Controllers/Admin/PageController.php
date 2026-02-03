<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Language; // Assuming you have a Language model to fetch languages

class PageController extends Controller
{

    public function index()
    {
        // code to list all pages where lang is en
        $pages = Page::where('lang', 'tr')->get();
        $languages = Language::all(); // Assuming you have a Language model to fetch languages
        return view('admin.page.index', compact('pages', 'languages'));
    }

    public function create()
    {
        // code to show create page form
        $languages = Language::all();
        return view('admin.page.create', compact('languages'));
    }

    public function store(Request $request)
    {
        // code to store new page

        //dd($request->all());

        if ($request->has('page_id')) {
                $page_id = $request->page_id; // Use the provided page_id
            }else{
                $page_id = Page::max('page_id') + 1; // Increment the maximum page_id by 1
                if (!$page_id) {
                    $page_id = 1; // If no page items exist, start with 1
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
                        'image_' . $language->lang_code => 'nullable|image|max:2048', // Assuming image is optional
                        'alt_' . $language->lang_code => 'required|max:255',
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

                Page::updateOrCreate(
                    ['page_id' => $page_id, 'lang' => $language->lang_code],
                    [
                        'title' => $request->input('title_' . $language->lang_code) ?? $request->input('title_en'),
                        'description' => $request->input('description_' . $language->lang_code) ?? $request->input('description_en'),
                        'image' => $imageName,
                        'alt' => $request->input('alt_' . $language->lang_code) ?? $request->input('alt_en'),
                        'seo_url' => $request->input('seo_url_' . $language->lang_code) ?? $request->input('seo_url_en'),
                        'seo_title' => $request->input('seo_title_' . $language->lang_code) ?? $request->input('seo_title_en'),
                        'seo_description' => $request->input('seo_description_' . $language->lang_code) ?? $request->input('seo_description_en'),
                        'seo_keywords' => $request->input('seo_keywords_' . $language->lang_code) ?? $request->input('seo_keywords_en'),
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                );

            }



            return redirect()->route('admin.page.index')->with('success', 'Page başarıyla kaydedildi.');
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // code to show edit page form
        $pages = Page::where('page_id', $id)->get();
        //dd($pages);
        $languages = Language::all();
        
        return view('admin.page.edit', compact('pages', 'languages'));
    }

    public function destroy($id)
    {
        // code to delete page
        Page::where('page_id', $id)->delete();
        PageSlider::where('page_id', $id)->delete();
        return redirect()->route('admin.page')->with('success', 'Page başarıyla silindi.');
    }

}
