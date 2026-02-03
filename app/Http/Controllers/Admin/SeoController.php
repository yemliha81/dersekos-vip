<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoSettings;
use App\Models\Language; // Assuming you have a Language model to fetch languages
use Illuminate\Support\Facades\DB; // For database operations

class SeoController extends Controller
{
    protected $languages;

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }
    // Display a list of seos
    public function index()
    {
        $seo_settings = SeoSettings::where('lang', app()->getLocale())->get();
        return view('admin.seo.index', compact('seo_settings'));
    }

    // Show form to create a new seo
    public function create()
    {
        return view('admin.seo.create');
    }

    // Store new seo in database
    public function store(Request $request)
    {
        if ($request->has('seo_id')) {
            $seo_id = $request->seo_id; // Use the provided seo_id
        } else {
            $seo_id = SeoSettings::max('seo_id') + 1; // Increment the maximum seo_id by 1
            if (!$seo_id) {
                $seo_id = 1; // If no seo items exist, start with 1
            }
        }
        try {
            foreach($this->languages as $language){
                if($language->lang_code == 'tr'){
                    
                    $request->validate([
                        'lang_'.$language->lang_code => 'required|string|max:10',
                        'page_'.$language->lang_code => 'required|string|max:100',
                        'seo_title_'.$language->lang_code => 'nullable|string|max:255',
                        'seo_description_'.$language->lang_code => 'nullable|string|max:255',
                        'seo_keywords_'.$language->lang_code => 'nullable|string|max:255',
                    ]);
                }

               

                $data = [
                    'lang' => $language->lang_code,
                    'seo_id' => $seo_id,
                    'page' => $request->input('page_'.$language->lang_code) ?? $request->input('page_en'),
                    'seo_title' => $request->input('seo_title_'.$language->lang_code) ?? $request->input('seo_title_en'),
                    'seo_description' => $request->input('seo_description_'.$language->lang_code) ?? $request->input('seo_description_en'),
                    'seo_keywords' => $request->input('seo_keywords_'.$language->lang_code) ?? $request->input('seo_keywords_en'),
                ];

                //dd($data);

                SeoSettings::updateOrCreate(
                    ['seo_id' => $seo_id, 'lang' => $language->lang_code],
                    $data
                );

                
            }

            return redirect()->route('admin.seo.index')->with('success', 'Seo ayarları başarıyla kaydedildi!');

        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('admin.seo.index')->with('error', 'Seo ayarları kaydedilirken bir hata oluştu!');
        }
    }

    // Show form to edit seo
    public function edit($id)
    {
        $seo_settings = SeoSettings::where('seo_id', $id)->get();
        //dd($seo_settings);
        return view('admin.seo.edit', compact('seo_settings', 'id'));
    }

    // Update seo
   

    // Delete seo
    public function destroy($seo_id)
    {
        $seo = SeoSettings::where('seo_id', $seo_id)->get();

        // Delete each row
        foreach ($seo as $item) {
            $item->delete();
        }

        return redirect()->route('admin.seo.index')->with('success', 'Seo ayarları başarıyla silindi!');
    }

    
}
