<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Language;
use App\Models\Blog;
use App\Models\About;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\ContentCategory;
use App\Models\Content;
use App\Models\SeoSettings;
use App\Models\Teacher;
use App\Models\Event;
use App\Models\Campaign;
use App\Models\VipPackage;
use App\Models\ExamStudent;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $seo['title'] = 'Anasayfa | Derse Koş VIP';
        $seo['keywords'] = 'online dersler, LGS hazırlık, ilkokul dersleri, ortaokul dersleri, online matematik, online fen bilimleri, online Türkçe, online sosyal bilgiler, online İngilizce, online din kültürü, interaktif eğitim, deneme sınavı, uzaktan eğitim, eğitim platformu, derse koş';
        $seo['descriptipon'] = 'DERSE KOŞ - Online eğitim platformu. İlkokul, ortaokul ve LGS hazırlık için matematik, fen bilimleri, Türkçe, sosyal bilgiler, İngilizce ve din kültürü dersleri. İnteraktif içerikler, deneme sınavları ve uzman eğitmenlerle başarıya koşun!';
        return view('home', compact('seo'));
    }

    public function vipPackages()
    {

        $vip_packages = VipPackage::where('type', 'package')->get();

        $seo['title'] = 'VIP Okula Destek ve LGS Hazırlık Paketlerimiz | Derse Koş VIP';
        $seo['keywords'] = 'eğitim paketi, LGS hazırlık seti, matematik paketi, fen bilimleri paketi, Türkçe paketi, sosyal bilgiler paketi, İngilizce paketi, din kültürü paketi, online ders paketi, konu anlatım videosu, deneme sınavı';
        $seo['descriptipon'] = '5., 6., 7. ve 8. sınıf tüm ders paketleri. Matematik, fen bilimleri, Türkçe, sosyal bilgiler, İngilizce ve din kültürü. LGS hazırlık setleri, konu anlatımlı videolar, interaktif sorular ve deneme sınavları.';

        return view('vip-packages', compact( 'vip_packages', 'seo'));

    }

    public function vipCamps()
    {

        $vip_camps = VipPackage::where('type', 'camp')->get();

        $seo['title'] = 'VIP Kamplarımız | Derse Koş VIP';
        $seo['descriptipon'] = 'Tüm dersleri kapsayan yoğunlaştırılmış LGS kampları. Matematik, fen bilimleri, Türkçe, sosyal bilgiler, İngilizce ve din kültürü branşlarında tatil dönemi kampları ve sınav maratonu programları.';
        $seo['keywords'] = 'LGS hazırlık kampı, matematik kampı, fen bilimleri kampı, Türkçe kampı, sosyal bilgiler kampı, İngilizce kampı, din kültürü kampı, yaz kampı, sınav maratonu, yoğun eğitim kampı';
        return view('vip-camps', compact( 'vip_camps', 'seo'));

    }

    public function purchaseVipPackage($id){
        $vip_package = VipPackage::find($id);
        return view('vip-package-purchase', compact('vip_package'));
    }

    //purchaseVipPackagePost
    public function purchaseVipPackagePost(Request $request){
        //$vip_package = VipPackage::find($id);
        //dd($vip_package);
        // Here you would handle the payment process and order creation
        // For demonstration, we'll just return a success message

        return redirect()->route('vip.packages')->with('success', 'VIP paketi satın alma işlemi başarılı!');

    }

    public function statistics(){
        $events = Event::where('is_free', 1)->get();
        $total_attendees = 0;
        foreach($events as $event){
            $event->registrations = count(explode(',', $event->attendees));
            $total_attendees += $event->registrations;

        }
        dd($total_attendees);
    }

    public function teacherStats(){
        $teacherArray = [];
        $teachers = Teacher::all();
        foreach($teachers as $teacher){
            $teacher->event_count = Event::where(['teacher_id' => $teacher->id, 'is_free' => 1])
            //where start is smaller than today
            ->where('start', '<=', date('Y-m-d H:i:s'))
            ->count();
            $teacherArray[] = [$teacher->name. '|' . $teacher->branch, $teacher->event_count];
        }
        // sort by event_count desc
        usort($teacherArray, function($a, $b) {
            return $b[1] <=> $a[1];
        });


        debug($teacherArray);
    }

    public function route($slug, $slug2 = null)
    {
        $menu = Menu::where(['seo_url' => $slug, 'lang' => app()->getLocale()])->firstOrFail();
        //dd($menu);
        // If the menu item has a page_type of 'about', fetch the about data
        if($menu->page_type == 'about') {
            $about = About::where('lang', app()->getLocale())->first();
            
            $how_we_do = DB::table('about_how_we_do')->where('lang', app()->getLocale())->get()->toArray();
            $what_we_do =  DB::table('about_what_we_do')->where('lang', app()->getLocale())->get()->toArray();
            $memberships = DB::table('about_memberships')->where('lang', app()->getLocale())->get()->toArray();
            //debug($memberships);
            $seo = SeoSettings::where('page', 'about')->where('lang', app()->getLocale())->first();
            $politics = DB::table('about_politics')->where('lang', app()->getLocale())->get()->toArray();
            //dd($politics);
            return view('about', compact('about', 'how_we_do', 'what_we_do', 'memberships', 'politics', 'seo'));
        }

        if($menu->page_type == 'grade') {


            if($slug2 != null) {
                $grade = Grade::where('seo_url', $slug)->where('lang', app()->getLocale())->first();
                $lesson = Lesson::where(['seo_url' => $slug2, 'lang' => app()->getLocale(), 'grade_id' => $grade->grade_id])->first();
                
                $categories = ContentCategory::where(['lesson_id' => $lesson->lesson_id, 'lang' => app()->getLocale(), 'parent_category_id' => 0])
                ->with(['children', 'contents'])->get();
                //dd($categories);

                $seo = $lesson;

                return view('lesson', compact('grade', 'lesson', 'categories', 'seo'));
            }



            $grade = Grade::where('seo_url', $slug)->where('lang', app()->getLocale())->first();

            //dd($grade);

            $lessons = Lesson::where('grade_id', $grade->grade_id)->where('lang', app()->getLocale())->get();

            //dd($lessons);
            
            //$seo = SeoSettings::where('page', 'grades')->where('lang', app()->getLocale())->first();
            return view('grade', compact('grade', 'lessons'));

        }


        if($menu->page_type == 'blog') {
            if($slug2!= null) {
                // Get blog posts limit 5 as array
                $blogs = Blog::where(['lang' => app()->getLocale()])->orderBy('sort')->limit(5)->get()->toArray();
                //dd($blogs);
                $blog = Blog::where(['lang' => app()->getLocale(), 'seo_url' => $slug2])->firstOrFail();
                $seo = $blog;
                $blogSlider = BlogSlider::where(['lang' => app()->getLocale(), 'blog_id' => $blog->blog_id])->get();
                //dd($blogSlider);
                return view('blog-detail', compact('blog', 'blogs', 'blogSlider', 'seo'));
            }else{
                $seo = SeoSettings::where('page', 'news')->where('lang', app()->getLocale())->first();
                
                $blogs = Blog::where(['lang' => app()->getLocale()])->orderBy('sort')->limit(5)->get()->toArray();
                return view('blog', compact('blogs', 'seo'));
            }
            
        }

        if($menu->page_type == 'contact') {
            $offices = Office::where(['lang' => app()->getLocale()])->get();
            $seo['title'] = 'İletişim | Derse Koş VIP';
            $seo['keywords'] = 'derse koş iletişim, online eğitim destek, ders danışma, eğitim platformu iletişim, dersekos vip destek, öğrenci hizmetleri, branş dersleri bilgi';//SeoSettings::where('page', 'contact')->where('lang', app()->getLocale())->first();
            $seo['description'] = 'DERSE KOŞ iletişim bilgileri. Matematik, fen, Türkçe, sosyal bilgiler, İngilizce ve din kültürü dersleri hakkında sorularınız için bize ulaşın: info@dersekos.com';
            return view('contact', compact('offices', 'seo'));
        }

        if($menu->page_type == 'page') {
            $page = Page::where(['lang' => app()->getLocale(), 'seo_url' => $slug])->first();
            $seo = $page;
            //dd($page);
            return view('page', compact('page', 'seo'));
        }

        //return view('page', compact('page'));
    }


    //about page
    public function about()
    {
        $seo['title'] = 'Hakkımızda | Derse Koş VIP';
        $seo['keywords'] = 'derse koş hakkında, online eğitim platformu, çok branşlı eğitim, maarif modeli dersler, eğitim misyonu, uzaktan eğitim ekibi, kaliteli ders içerikleri, öğrenci başarısı, eğitim teknolojileri';
        $seo['description'] = 'DERSE KOŞ ekibi olarak 3000+ öğrenciye ulaşan, yenilikçi Maarif Modeli müfredatına uygun eğitim sunuyoruz. Matematikten İngilizceye, fen bilimlerinden din kültürüne tüm branşlarda kaliteli içerik üretiyoruz.';
        return view('about');
    }

    //about page
    public function contact()
    {
        $seo['title'] = 'İletişim | Derse Koş VIP';
        $seo['keywords'] = 'derse koş iletişim, online eğitim destek, ders danışma, eğitim platformu iletişim, dersekos vip destek, öğrenci hizmetleri, branş dersleri bilgi';//SeoSettings::where('page', 'contact')->where('lang', app()->getLocale())->first();
        $seo['description'] = 'DERSE KOŞ iletişim bilgileri. Matematik, fen, Türkçe, sosyal bilgiler, İngilizce ve din kültürü dersleri hakkında sorularınız için bize ulaşın: info@dersekos.com';
        return view('contact', compact('seo'));
    }

    //rfund page
    public function refund()
    {
        return view('teslimat-iade');
    }

    //privacy page
    public function privacy()
    {
        return view('gizlilik');
    }
    
    //contract page
    public function contract()
    {
        return view('sozlesme');
    }

    public function teachersList(){
        $teachers = Teacher::where(['status' => 1, 'is_vip' => 1])->with('reviews')
        //where image is not null and not empty first
        ->orderByRaw("CASE 
            WHEN image IS NULL OR image = '' THEN 1 
            ELSE 0 
        END")
        ->orderBy('id')
        ->get();
        $seo['title'] = 'Eğitmen Kadromuz | Derse Koş VIP';
        $seo['keywords'] = 'matematik öğretmeni, fen bilimleri öğretmeni, Türkçe öğretmeni, sosyal bilgiler öğretmeni, İngilizce öğretmeni, din kültürü öğretmeni, LGS uzmanı eğitmen, online branş öğretmeni, eğitmen kadrosu';
        $seo['description'] = 'Tüm branşlarda uzman eğitmen kadromuzla tanışın. Matematik, fen bilimleri, Türkçe, sosyal bilgiler, İngilizce ve din kültürü öğretmenlerimiz. LGS hazırlık uzmanları ve deneyimli branş öğretmenleri.';
        //dd($teachers);
        return view('teachers_list', compact('teachers', 'seo'));
    }  

   

    
}
