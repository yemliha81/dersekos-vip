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
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        //die(bcrypt('drs123*'));
        // cache teachers for 60 minutes
        $teachers = cache()->remember('teachers', 60, function () {
            return Teacher::orderByRaw("
                CASE 
                    WHEN image IS NULL OR image = '' THEN 1 
                    ELSE 0 
                END
            ")->where('status', 1)->get();
        });
        

        //dd($teachers);
        //$languages = Language::all();

        //$menuItems = Menu::where(['lang' => app()->getLocale(), 'parent_menu_id' => 0, 'menu_type' => 'header'])->get();

        return view('home', compact('teachers'));
    }

    public function campRegistration()
    {
        $meta_title = "2025 - 2026 Ara Tatil Kamplarımız";

        $campaigns = Campaign::where('status', 1)
        //->where('campaign_start', '>', date('Y-m-d'))
        ->orderBy('id', 'desc')
        ->get();

        //dd($campaigns);

        return view('camp_registration', compact('meta_title', 'campaigns'));

    }

    public function campsList()
    {
        $meta_title = "2025 - 2026 Ara Tatil Kamplarımız";

        return view('camps', compact('meta_title'));

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
            $seo = SeoSettings::where('page', 'contact')->where('lang', app()->getLocale())->first();
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
    

    
}
