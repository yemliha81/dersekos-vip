<?php
//Create a new file at app/Http/Controllers/Admin/MenuController.php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Language;
class MenuController extends Controller
{
    
    /**
     * Display a listing of the menu items.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Here you would typically fetch menu items from the database
        // For now, we will return a simple view
        // Fetch all menu items where lang is 'en'
        if($request->route('type') == 'footer'){

            $menus = Menu::where(['lang' => 'en', 'parent_menu_id' => 0, 'menu_type' => 'footer'])->orderBy('sort')->with('children')->get();
            $type = 'footer';
            //dd($menus);
            return view('admin.menu.index', compact('menus','type'));
        }


        $menus = Menu::where(['lang' => 'tr', 'parent_menu_id' => 0, 'menu_type' => 'header'])->orderBy('sort')->with('children')->get();

        //dd($menus);
        if(!$request->route('type')){
            $type = 'header';
        }else{
            $type = $request->route('type');
        }
        //dd($request->route('type'));
        return view('admin.menu.index', compact('menus','type'));
    }

    // You can add more methods here for creating, editing, and deleting menu items
    /**
     * Show the form for creating a new menu item.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $type = $request->route('type'); // Get the type from the route parameter
        $parentMenus = Menu::where(['lang' => app()->getLocale(), 'parent_menu_id' => 0, 'menu_type' => $type])->get(); // Fetch all parent menus for the dropdown
        $languages = Language::all(); // Fetch all languages for the dropdown
        
        return view('admin.menu.create', compact('languages', 'parentMenus', 'type'));
    }

    /**
     * Store a newly created menu item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        
        //dd($request->all()); // Debugging line to check the request data
        try {
            $languages = Language::all(); // Fetch all languages for the dropdown

            // Check if the request has a menu_id, if not, insert new row, else update existing
            if ($request->has('menu_id')) {
                $menu_id = $request->menu_id; // Use the provided menu_id
            }else{
                $menu_id = Menu::max('menu_id') + 1; // Increment the maximum menu_id by 1
                if (!$menu_id) {
                    $menu_id = 1; // If no menu items exist, start with 1
                }
            }
                //Update or create existing menu items for the given menu_id
                foreach ($languages as $language) {
                    // Validate the request data for each language
                    if($language->lang_code == 'tr'){
                        $request->validate([
                            'lang_' . $language->lang_code => 'required|max:10',
                            'parent_menu_id_' . $language->lang_code => 'nullable|integer',
                            'title_' . $language->lang_code => 'required|max:255',
                            'seo_url_' . $language->lang_code => 'required|max:255',
                            'image_' . $language->lang_code => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                            'alt_' . $language->lang_code => 'nullable|max:255',
                            'menu_type_' . $language->lang_code => 'required|in:header,footer,sidebar', // Assuming these are the valid types
                            'page_type_' . $language->lang_code => 'required|max:255',
                            'url_block_' . $language->lang_code => 'nullable|boolean',
                            'sort' => 'nullable|integer',
                            'isActive' => 'boolean',
                        ]);
                    }
                    // save image if it exists
                    if ($request->hasFile('image_tr') || $request->hasFile('image_' . $language->lang_code)) {
                        $tmpImgPath = createTmpFile($request, 'image_tr', $languages[0]);
                        $imageName = moveFile($request,$language,'image_' . $language->lang_code, 'image_tr', 'title_' . $language->lang_code, 'title_en', $language->images_folder, $tmpImgPath);
                        //dd($imageName);
                    }else{
                        $imageName = $request->input('old_image_' . $language->lang_code, null); // Use old image if no new image is uploaded
                    }

                    // Update or create the menu item for the specific language
                    Menu::updateOrCreate(
                        [
                            'menu_id' => $menu_id,
                            'lang' => $language->lang_code,
                        ],
                        [
                            'parent_menu_id' => $request->input('parent_menu_id_en') ?? $request->input('parent_menu_id_' . $language->lang_code) ?? 0,
                            'title' => $request->input('title_' . $language->lang_code) ?? $request->input('title_en'),
                            'seo_url' => $request->input('seo_url_' . $language->lang_code) ?? $request->input('seo_url_en'),
                            'image' => $imageName, // save relative path
                            'alt' => $request->input('alt_' . $language->lang_code) ?? $request->input('alt_en'),
                            'menu_type' => $request->input('menu_type_' . $language->lang_code) ?? $request->input('menu_type_en'),
                            'page_type' => $request->input('page_type_' . $language->lang_code) ?? $request->input('page_type_en'),
                            'url_block' => $request->has('url_block_' . $language->lang_code) ?? $request->input('url_block_en'),
                            'sort' => $request->input('sort_' . $language->lang_code) ?? 0, // default to 0 if not provided
                            'isActive' => $request->isActive ? 1 : 0
                        ]
                    );
                }   

        // Redirect back with success message
        $type = $request->input('menu_type_' . $language->lang_code) ?? $request->input('menu_type_en');

        if ($type) {
            $url = $type == 'header' ? env('HTTP_DOMAIN') . '/admin/menu' : env('HTTP_DOMAIN') . '/admin/footer-menu/footer';
        } else {
            $url = env('HTTP_DOMAIN') . '/admin/menu';
        }
            return redirect()->back()->with('success', 'Menü başarıyla kaydedildi.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }
       
    }

    /**
     * Show the form for editing the specified menu item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $menu_items = Menu::where('menu_id', $id)->get(); // Fetch all menu items with the same menu_id
        $type = $menu_items[0]->menu_type;



        $parentMenus = Menu::where(['lang' => app()->getLocale(), 'parent_menu_id' => 0, 'menu_type' => $type])->get(); // Fetch all parent menus for the dropdown
        
        //dd($menu_items); // Debugging line to check the menu data
        $languages = Language::all(); // Fetch all languages for the dropdown
        return view('admin.menu.edit', compact('menu_items', 'languages', 'parentMenus'));

    }

    /**
     * Remove the specified menu item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Find the menu items by menu_id and delete them
            $menu_items = Menu::where('menu_id', $id)->get();
            $type = $menu_items[0]->menu_type;

            //dd($type);
            if ($menu_items->isEmpty()) {
                return redirect()->route('admin.menu')->withErrors(['error' => 'Menu item not found.']);
            }
            foreach ($menu_items as $menu_item) {
                // If the image exists, delete it from storage
                /*if ($menu_item->image && \Storage::disk('public')->exists('images/' . $menu_item->image)) {
                    \Storage::disk('public')->delete('images/' . $menu_item->image);
                }*/
                $menu_item->delete(); // Delete the menu item
            }
            if( $type) {
                $to = $type == 'header' ? env('HTTP_DOMAIN') . '/admin/menu' : env('HTTP_DOMAIN') . '/admin/footer-menu/footer';
            } else {
                $to = env('HTTP_DOMAIN') . '/admin/menu';
            }
            return redirect()->to($to)->with('success', 'Menü basarıyla silindi.');

        } catch (\Exception $e) {
            return redirect()->route('admin.menu')->withErrors(['error' => 'Hata oluştu: ' . $e->getMessage()]);
        }   

    }




}