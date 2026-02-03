<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterInfo; // Assuming you have a FooterInfo model
use App\Models\Language; // Assuming you have a Language model to fetch languages
use Illuminate\Support\Facades\DB; // For database operations

class FooterInfoController extends Controller
{
    protected $languages;

    public function __construct()
    {
        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    public function index()
    {
        $footerInfo = FooterInfo::all();
        return view('admin.footer_info.index', compact('footerInfo'));
    }

    public function create()
    {
        $footerInfos = FooterInfo::get();
        //dd($footerInfos);
        if($footerInfos->isEmpty()) {
            return view('admin.footer_info.create');
        }else{
            return view('admin.footer_info.edit', compact('footerInfos'));
        }
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {

            foreach($this->languages as $language) {
                if($language == 'en'){
                    $request->validate([
                        'address_' . $language->lang_code => 'required|max:255',
                        'phone_' . $language->lang_code => 'required|max:255',
                        'email_' . $language->lang_code => 'required|email|max:255',
                        'map_url_' . $language->lang_code => 'required|max:255',
                        'facebook_url_' . $language->lang_code => 'required|max:255',
                        'youtube_url_' . $language->lang_code => 'nullable|max:255',
                        'linkedin_url_' . $language->lang_code => 'nullable|max:255',
                        'x_url_' . $language->lang_code => 'nullable|max:255',
                        'instagram_url_' . $language->lang_code => 'nullable|max:255',
                        'footer_text_' . $language->lang_code => 'required|max:100',
                        'footer_logo_' . $language->lang_code => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                        'alt_' . $language->lang_code => 'required|max:255',
                    ]);
                }

                if ($request->hasFile('footer_logo_en') || $request->hasFile('footer_logo_' . $language->lang_code)) {
                    $tmpImgPath = createTmpFile($request, 'footer_logo_en', $this->languages[0]);
                    $imageName = moveFile($request,$language,'image_' . $language->lang_code, 'footer_logo_en', 'alt_' . $language->lang_code, 'alt_en', $language->images_folder, $tmpImgPath);
                    //dd($imageName);
                }else{
                    $imageName = $request->input('old_image_' . $language->lang_code, null); // Use old image if no new image is uploaded
                }

                FooterInfo::updateOrCreate(
                    ['lang' => $language->lang_code],
                    [
                        'address' => $request->input('address_' . $language->lang_code),
                        'phone' => $request->input('phone_' . $language->lang_code),
                        'email' => $request->input('email_' . $language->lang_code),
                        'map_url' => $request->input('map_url_' . $language->lang_code),
                        'facebook_url' => $request->input('facebook_url_' . $language->lang_code),
                        'youtube_url' => $request->input('youtube_url_' . $language->lang_code),
                        'linkedin_url' => $request->input('linkedin_url_' . $language->lang_code),
                        'x_url' => $request->input('x_url_' . $language->lang_code),
                        'instagram_url' => $request->input('instagram_url_' . $language->lang_code),
                        'footer_text' => $request->input('footer_text_' . $language->lang_code) ?? $request->input('footer_text_en'),
                        'footer_logo' => $imageName,
                        'alt' => $request->input('alt_' . $language->lang_code) ?? $request->input('alt_en'),
                    ]
                );
            }

            return redirect()->back()->with('success', 'Footer bilgisi başarıyla kaydedildi.');

       } catch (\Throwable $th) {
            throw $th;
       }
    }

    public function edit($id)
    {
        $footerInfo = FooterInfo::all();
        dd($footerInfo);
        return view('admin.footer_info.edit', compact('footerInfo'));
    }

    public function destroy($id)
    {
        $footerInfo = FooterInfo::findOrFail($id);
        $footerInfo->delete();
        return redirect()->route('admin.footer_info.index');
    }


    public function updateSortOrder(Request $request)
    {
        //dd($request);
        $order = $request->input('order'); // ["2","1","3"]
        $table = $request->input('table');
        $column_name = $request->input('column_name');

        foreach ($order as $index => $id) {
            DB::table($table)
                ->where($column_name, $id)
                ->update(['sort' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }
}
