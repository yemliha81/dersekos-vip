<?php
//Create a new file at app/Http/Controllers/Admin/MenuController.php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
class LanguageController extends Controller
{
    
    /**
     * Display a listing of the menu items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Here you would typically fetch menu items from the database
        // For now, we will return a simple view
        $languages =  Language::all(); // Fetch all menu items
        return view('admin.language.index', compact('languages'));
    }

    // You can add more methods here for creating, editing, and deleting menu items
    /**
     * Show the form for creating a new menu item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $languages =  Language::all(); // Fetch all menu items
        return view('admin.language.create', compact('languages'));
    }

    /**
     * Store a newly created menu item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            //Create or update existing language items
            // Check if the request has an id field to determine if it's an update or create

            if($request->has('id')) {
                $language = Language::findOrFail($request->id);
            } else {
                $language = new Language();
            }

            $request->validate([
                'lang_code' => 'required|max:10',
                'flag_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validate image file
                'title' => 'required|max:255',
                'domain' => 'required|max:255',
                'path' => 'required|max:255',
                'about_url' => 'nullable|string|max:255',
                
                'blog_url' => 'nullable|string|max:255',
                'contact_url' => 'nullable|string|max:255',
                'uploads_folder' => 'nullable|string|max:255',
                'images_folder' => 'nullable|string|max:255',
                
                'blog_images_folder' => 'nullable|string|max:255',
                
                'ga_code' => 'nullable|string|max:100',
                'bitrix_form_code' => 'nullable|string|max:100',
                'bitrix_widget_code' => 'nullable|string|max:100',
                'sort' => 'nullable|integer'
            ]);

            if ($request->hasFile('flag_image')) {
                // Save the uploaded image
                $folderPath = $request->input('path').'/'.$request->input('uploads_folder').'/'.$request->input('images_folder');
                // Create folder if it doesn't exist
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $image = $request->file('flag_image');
                    $imageName = seoUrl($request->input('lang_code')) . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $image->move($folderPath, $imageName); // Save to public/en/images

                $language->flag_image = $imageName;

            } else {
                $language->flag_image = $request->input('old_flag_image', null); // Use old image if no new image is uploaded
            }

            // Fill the language model with the request data
            Language::updateOrCreate(
                ['lang_code' => $request->lang_code],
                [
                    'lang_code' => $request->lang_code,
                    'flag_image' => $language->flag_image,
                    'title' => $request->title,
                    'domain' => $request->domain,
                    'path' => $request->path,
                    'about_url' => $request->about_url,
                    'blog_url' => $request->blog_url,
                    'contact_url' => $request->contact_url,
                    'uploads_folder' => $request->uploads_folder,
                    'images_folder' => $request->images_folder,
                    
                    'blog_images_folder' => $request->blog_images_folder,
                    'ga_code' => $request->ga_code,
                    'bitrix_form_code' => $request->bitrix_form_code,
                    'bitrix_widget_code' => $request->bitrix_widget_code,
                    'sort' => $request->sort
                ]
            );


            // Redirect back with success message
            return redirect()->back()
                         ->with('success', 'Language item created successfully!');
            //return redirect()->route('admin.menu')->with('success', 'Menu item created successfully.');
        } catch (\Exception $e) {
            die($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create language item: ' . $e->getMessage()]);
        }
       
    }

    /**
     * Show the form for editing the specified language item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id); // Fetch the language item by ID
        return view('admin.language.edit', compact('language'));    
    }





}