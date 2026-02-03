<?php
//insert Admin/MenuController
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\SeederController;




// Login route
Route::get('/admin/login', 'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');

//Project Admin Routes

// Wrap all admin routes with Auth middleware
Route::middleware(['auth'])->group(function () {

Route::get('/run-student-seeder', [SeederController::class, 'runStudentSeeder']);

Route::get('/admin', 'App\Http\Controllers\Admin\DashboardController@dashboard')->name('admin.dashboard');
Route::get('/admin/students', 'App\Http\Controllers\Admin\DashboardController@students')->name('admin.students');
Route::get('/admin/students/{id}', 'App\Http\Controllers\Admin\DashboardController@studentShow')->name('admin.students.show');

Route::get('/admin/teachers', 'App\Http\Controllers\Admin\DashboardController@teachers')->name('admin.teachers');

Route::get('/admin/events/{type}', 'App\Http\Controllers\Admin\DashboardController@events')->name('admin.events');
Route::get('/admin/event/{id}', 'App\Http\Controllers\Admin\DashboardController@eventShow')->name('admin.events.show');

Route::get('/admin/events/create', 'App\Http\Controllers\Admin\EventsController@create')->name('admin.events.create');
Route::post('/admin/events/store', 'App\Http\Controllers\Admin\EventsController@store')->name('admin.events.store');

Route::get('/admin/teachers/{id}', 'App\Http\Controllers\Admin\TeacherController@teacherShow')->name('admin.teachers.show');
Route::post('/admin/teachers/store', 'App\Http\Controllers\Admin\TeacherController@store')->name('admin.teachers.store');
Route::get('/admin/teachers/delete/{id}', 'App\Http\Controllers\Admin\TeacherController@delete')->name('admin.teachers.delete');


// admin/menu route to menu controller index function
Route::get('/admin/menu', 'App\Http\Controllers\Admin\MenuController@index')->name('admin.menu');
Route ::get('/admin/menu/create/{$type}', 'App\Http\Controllers\Admin\MenuController@create')->name('admin.menu.create');
Route::post('/admin/menu/store', 'App\Http\Controllers\Admin\MenuController@store')->name('admin.menu.store');
Route::get('/admin/menu/{id}/edit', 'App\Http\Controllers\Admin\MenuController@edit')->name('admin.menu.edit');
//Route::put('/admin/menu/{id}', 'App\Http\Controllers\Admin\MenuController@update')->name('admin.menu.update');
Route::delete('/admin/menu/{id}', 'App\Http\Controllers\Admin\MenuController@destroy')->name('admin.menu.destroy');

// admin/footer menu routes
Route::get('/admin/footer-menu/{type}', 'App\Http\Controllers\Admin\MenuController@index')->name('admin.menu.footer');
Route::get('/admin/menu/create/{type}', 'App\Http\Controllers\Admin\MenuController@create')->name('admin.menu.footer.create');
Route::post('/admin/menu/store/{type}', 'App\Http\Controllers\Admin\MenuController@store')->name('admin.menu.footer.store');
Route::get('/admin/menu/{id}/edit/{type}', 'App\Http\Controllers\Admin\MenuController@edit')->name('admin.menu.footer.edit');
//Route::put('/admin/menu/{id}', 'App\Http\Controllers\Admin\MenuController@update')->name('admin.menu.update');
Route::delete('/admin/menu/{id}/{type}', 'App\Http\Controllers\Admin\MenuController@destroy')->name('admin.menu.footer.destroy');

// admin/language route to language controller index function
Route::get('/admin/language', 'App\Http\Controllers\Admin\LanguageController@index')->name('admin.language');
Route::get('/admin/language/create', 'App\Http\Controllers\Admin\LanguageController@create')->name('admin.language.create');
Route::post('/admin/language/store', 'App\Http\Controllers\Admin\LanguageController@store')->name('admin.language.store');
Route::get('/admin/language/{id}/edit', 'App\Http\Controllers\Admin\LanguageController@edit')->name('admin.language.edit');
Route::put('/admin/language/{id}', 'App\Http\Controllers\Admin\LanguageController@update')->name('admin.language.update');
Route::delete('/admin/language/{id}', 'App\Http\Controllers\Admin\LanguageController@destroy')->name('admin.language.destroy');

// admin/about route to about controller index function
Route::get('/admin/about', 'App\Http\Controllers\Admin\AboutController@index')->name('admin.about');
Route::get('/admin/about/create', 'App\Http\Controllers\Admin\AboutController@create')->name('admin.about.create');
Route::post('/admin/about/store', 'App\Http\Controllers\Admin\AboutController@store')->name('admin.about.store');
Route::get('/admin/about/edit', 'App\Http\Controllers\Admin\AboutController@edit')->name('admin.about.edit');
//Route::put('/admin/about/{id}', 'App\Http\Controllers\Admin\AboutController@update')->name('admin.about.update');
Route::delete('/admin/about/{id}', 'App\Http\Controllers\Admin\AboutController@destroy')->name('admin.about.destroy');


// admin/grade route to grade controller index function
Route::get('/admin/grade', 'App\Http\Controllers\Admin\GradeController@index')->name('admin.grade');
Route::get('/admin/grade/create', 'App\Http\Controllers\Admin\GradeController@create')->name('admin.grade.create');
Route::post('/admin/grade/store', 'App\Http\Controllers\Admin\GradeController@store')->name('admin.grade.store');
Route::get('/admin/grade/{id}/edit', 'App\Http\Controllers\Admin\GradeController@edit')->name('admin.grade.edit');
Route::delete('/admin/grade/{id}', 'App\Http\Controllers\Admin\GradeController@destroy')->name('admin.grade.destroy');

// admin/grade/{id}/lessons route to grade controller lessons function
Route::get('/admin/grade/{id}/lessons', 'App\Http\Controllers\Admin\GradeController@lessons')->name('admin.grade.lessons');
// admin/lesson routes
Route::get('/admin/lesson/{grade_id}/create', 'App\Http\Controllers\Admin\LessonController@create')->name('admin.lesson.create');
Route::post('/admin/lesson/store', 'App\Http\Controllers\Admin\LessonController@store')->name('admin.lesson.store');
Route::get('/admin/lesson/{id}/edit', 'App\Http\Controllers\Admin\LessonController@edit')->name('admin.lesson.edit');
Route::delete('/admin/lesson/{id}', 'App\Http\Controllers\Admin\LessonController@destroy')->name('admin.lesson.destroy');  

// admin/content routes
Route::get('/admin/category/{category_id}/contents', 'App\Http\Controllers\Admin\ContentController@index')->name('admin.content');
Route::get('/admin/category/{category_id}/content/create', 'App\Http\Controllers\Admin\ContentController@create')->name('admin.content.create');
Route::post('/admin/content/store', 'App\Http\Controllers\Admin\ContentController@store')->name('admin.content.store');
Route::get('/admin/content/{content_id}/edit', 'App\Http\Controllers\Admin\ContentController@edit')->name('admin.content.edit');
//Route::post('/admin/content/{id}', 'App\Http\Controllers\Admin\ContentController@update')->name('admin.content.update');
Route::delete('/admin/content/{content_id}', 'App\Http\Controllers\Admin\ContentController@destroy')->name('admin.content.destroy');

// admin/content_category routes
Route::get('/admin/lesson/{lesson_id}/content-categories', 'App\Http\Controllers\Admin\ContentCategoryController@index')->name('admin.content_category');
Route::get('/admin/lesson/{lesson_id}/content-category/create', 'App\Http\Controllers\Admin\ContentCategoryController@create')->name('admin.content_category.create');
Route::post('/admin/content-category/store', 'App\Http\Controllers\Admin\ContentCategoryController@store')->name('admin.content_category.store');
Route::get('/admin/content-category/{content_category_id}/edit', 'App\Http\Controllers\Admin\ContentCategoryController@edit')->name('admin.content_category.edit');
//Route::post('/admin/content-category/{id}', 'App\Http\Controllers\Admin\ContentCategoryController@update')->name('admin.content_category.update');
Route::delete('/admin/content-category/{content_category_id}', 'App\Http\Controllers\Admin\ContentCategoryController@destroy')->name('admin.content_category.destroy');

// blog routes
Route::get('/admin/blog', 'App\Http\Controllers\Admin\BlogController@index')->name('admin.blog');
Route::get('/admin/blog/create', 'App\Http\Controllers\Admin\BlogController@create')->name('admin.blog.create');
Route::post('/admin/blog/store', 'App\Http\Controllers\Admin\BlogController@store')->name('admin.blog.store');
Route::get('/admin/blog/{id}/edit', 'App\Http\Controllers\Admin\BlogController@edit')->name('admin.blog.edit');
//Route::post('/admin/blog/{id}', 'App\Http\Controllers\Admin\BlogController@update')->name('admin.blog.update');
Route::delete('/admin/blog/{id}', 'App\Http\Controllers\Admin\BlogController@destroy')->name('admin.blog.destroy');

// blog slider routes
Route::get('/admin/blog/{id}/slider', 'App\Http\Controllers\Admin\BlogController@sliderIndex')->name('admin.blog.slider.index');
Route::get('/admin/blog/{id}/slider/create', 'App\Http\Controllers\Admin\BlogController@sliderCreate')->name('admin.blog.slider.create');
Route::post('/admin/blog/{id}/slider/store', 'App\Http\Controllers\Admin\BlogController@sliderStore')->name('admin.blog.slider.store');
Route::get('/admin/blog/{id}/slider/{sliderId}/edit', 'App\Http\Controllers\Admin\BlogController@sliderEdit')->name('admin.blog.slider.edit');
//Route::post('/admin/blog/{id}/slider/{sliderId}', 'App\Http\Controllers\Admin\BlogController@update')->name('admin.blog.slider.update');
Route::delete('/admin/blog/{id}/slider/{sliderId}', 'App\Http\Controllers\Admin\BlogController@sliderDestroy')->name('admin.blog.slider.destroy');



// Slider Routes
Route::get('/admin/slider', 'App\Http\Controllers\Admin\SliderController@index')->name('admin.slider.index');
Route::get('/admin/slider/create', 'App\Http\Controllers\Admin\SliderController@create')->name('admin.slider.create');
Route::post('/admin/slider/store', 'App\Http\Controllers\Admin\SliderController@store')->name('admin.slider.store');
Route::get('/admin/slider/{sliderId}/edit', 'App\Http\Controllers\Admin\SliderController@edit')->name('admin.slider.edit');
Route::delete('/admin/slider/{sliderId}', 'App\Http\Controllers\Admin\SliderController@destroy')->name('admin.slider.destroy');

// Page routes
Route::get('/admin/page', 'App\Http\Controllers\Admin\PageController@index')->name('admin.page.index');
Route::get('/admin/page/create', 'App\Http\Controllers\Admin\PageController@create')->name('admin.page.create');
Route::post('/admin/page/store', 'App\Http\Controllers\Admin\PageController@store')->name('admin.page.store');
Route::get('/admin/page/{id}/edit', 'App\Http\Controllers\Admin\PageController@edit')->name('admin.page.edit');
Route::delete('/admin/page/{id}', 'App\Http\Controllers\Admin\PageController@destroy')->name('admin.page.destroy');

// Seo Settings routes SeoController
Route::get('/admin/seo', 'App\Http\Controllers\Admin\SeoController@index')->name('admin.seo.index');
Route::get('/admin/seo/create', 'App\Http\Controllers\Admin\SeoController@create')->name('admin.seo.create');
Route::post('/admin/seo/store', 'App\Http\Controllers\Admin\SeoController@store')->name('admin.seo.store');
Route::get('/admin/seo/{id}/edit', 'App\Http\Controllers\Admin\SeoController@edit')->name('admin.seo.edit');
Route::delete('/admin/seo/{id}', 'App\Http\Controllers\Admin\SeoController@destroy')->name('admin.seo.destroy');

// Static Text routes
Route::get('/admin/static-text', 'App\Http\Controllers\Admin\StaticTextController@index')->name('admin.static_text.index');
Route::get('/admin/static-text/create', 'App\Http\Controllers\Admin\StaticTextController@create')->name('admin.static_text.create');
Route::post('/admin/static-text/store', 'App\Http\Controllers\Admin\StaticTextController@store')->name('admin.static_text.store');
Route::get('/admin/static-text/{id}/edit', 'App\Http\Controllers\Admin\StaticTextController@edit')->name('admin.static_text.edit');
Route::delete('/admin/static-text/{id}', 'App\Http\Controllers\Admin\StaticTextController@destroy')->name('admin.static_text.destroy');

// FooterInfo routes
Route::get('/admin/footer-info', 'App\Http\Controllers\Admin\FooterInfoController@index')->name('admin.footer_info.index');
Route::get('/admin/footer-info/create', 'App\Http\Controllers\Admin\FooterInfoController@create')->name('admin.footer_info.create');
Route::post('/admin/footer-info/store', 'App\Http\Controllers\Admin\FooterInfoController@store')->name('admin.footer_info.store');
Route::get('/admin/footer-info/{id}/edit', 'App\Http\Controllers\Admin\FooterInfoController@edit')->name('admin.footer_info.edit');
Route::delete('/admin/footer-info/{id}', 'App\Http\Controllers\Admin\FooterInfoController@destroy')->name('admin.footer_info.destroy');

Route::post('/admin/update-order', 'App\Http\Controllers\Admin\FooterInfoController@updateSortOrder')->name('admin.update_order');


// Quiz routes
Route::get('/admin/quiz', 'App\Http\Controllers\Admin\QuizController@index')->name('admin.quiz.index');
Route::get('/admin/quiz/create', 'App\Http\Controllers\Admin\QuizController@create')->name('admin.quiz.create');
Route::post('/admin/quiz/store', 'App\Http\Controllers\Admin\QuizController@store')->name('admin.quiz.store');
Route::get('/admin/quiz/{id}/edit', 'App\Http\Controllers\Admin\QuizController@edit')->name('admin.quiz.edit');
Route::delete('/admin/quiz/{id}', 'App\Http\Controllers\Admin\QuizController@destroy')->name('admin.quiz.destroy');

// Exam routes
Route::get('/admin/exam', 'App\Http\Controllers\Admin\ExamController@index')->name('admin.exam.index');
Route::get('/admin/exam/create', 'App\Http\Controllers\Admin\ExamController@create')->name('admin.exam.create');
Route::post('/admin/exam/store', 'App\Http\Controllers\Admin\ExamController@store')->name('admin.exam.store');
Route::get('/admin/exam/{id}/edit', 'App\Http\Controllers\Admin\ExamController@edit')->name('admin.exam.edit');
Route::delete('/admin/exam/{id}', 'App\Http\Controllers\Admin\ExamController@destroy')->name('admin.exam.destroy');

// Exam questions routes
Route::get('/admin/exam/{exam_id}/questions', 'App\Http\Controllers\Admin\ExamController@questionIndex')->name('admin.exam.question.index');
Route::get('/admin/exam/{exam_id}/question/create', 'App\Http\Controllers\Admin\ExamController@questionCreate')->name('admin.exam.question.create');
Route::post('/admin/exam/question/store', 'App\Http\Controllers\Admin\ExamController@questionStore')->name('admin.exam.question.store');
Route::get('/admin/exam/question/{question_id}/edit', 'App\Http\Controllers\Admin\ExamController@questionEdit')->name('admin.exam.question.edit');
Route::delete('/admin/exam/question/{question_id}', 'App\Http\Controllers\Admin\ExamController@questionDestroy')->name('admin.exam.question.destroy');


}); // End of Auth middleware group
//Project Front End routes
//Home route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
//Route::get('{slug}/{slug2?}', 'App\Http\Controllers\HomeController@route')->name('page.route');

Route::get('/giris', 'App\Http\Controllers\LoginController@showLoginForm')->name('student.login');
Route::post('/giris', 'App\Http\Controllers\LoginController@login')->name('student.login.submit');
Route::post('/kayit', 'App\Http\Controllers\LoginController@signup')->name('student.signup.submit');
Route::get('/cikis', 'App\Http\Controllers\LoginController@logout')->name('student.logout');
Route::get('/banned', 

    function () {
        return view('student.banned');
    }
)->name('student.banned');

// wrap student routes with auth middleware
// Student Dashboard route
Route::get('/student/dashboard', 'App\Http\Controllers\StudentController@dashboard')->middleware('auth:student')->name('student.dashboard');
Route::get('/student/dashboard234', 'App\Http\Controllers\StudentController@dashboard2')->middleware('auth:student')->name('student.dashboard2');
Route::get('/student/dashboard234', 'App\Http\Controllers\StudentController@dashboard2')->middleware('auth:student')->name('student.dashboard2');
Route::get('/student/old-lessons', 'App\Http\Controllers\StudentController@oldEvents')->middleware('auth:student')->name('student.old_lessons');
Route::post('/student/event-rate', 'App\Http\Controllers\StudentController@rateEvent')->middleware('auth:student')->name('student.event_rate');
Route::post('/student/join-free-lesson/{id}', 'App\Http\Controllers\StudentController@joinToEvent')->middleware('auth:student')->name('student.join_free_lesson');




// teacher routes
Route::get('/teacher/dashboard', 'App\Http\Controllers\TeacherController@dashboard')->middleware('auth:teacher')->name('teacher.dashboard');
Route::get('/ogretmen/giris', 'App\Http\Controllers\TeacherController@showLoginForm')->name('teacher.login');
Route::post('/ogretmen/giris', 'App\Http\Controllers\TeacherController@login')->name('teacher.login.submit');
Route::post('/ogretmen/kayit', 'App\Http\Controllers\TeacherController@signup')->name('teacher.signup.submit');
Route::post('/ogretmen/profil/duzenle', 'App\Http\Controllers\TeacherController@updateProfile')->middleware('auth:teacher')->name('teacher.profile.update');

Route::get('/teacher/dashboard', 'App\Http\Controllers\TeacherController@dashboard')->middleware('auth:teacher')->name('teacher.dashboard');
Route::get('/ogretmenler', 'App\Http\Controllers\TeacherController@listTeachers')->middleware('auth:student')->name('teacher.list');
Route::get('/ogretmen/{id}/profil', 'App\Http\Controllers\TeacherController@viewProfile')->middleware('auth:student')->name('teacher.profile');


// Campaign routes
Route::post('/ogretmen/kamp-olustur', 'App\Http\Controllers\TeacherController@storeCampaign')->middleware('auth:teacher')->name('teacher.campaign.store');

Route::get('/ogretmen/cikis', 'App\Http\Controllers\TeacherController@logout')->name('teacher.logout');


// login.choose route
Route::get('/login-choose', 'App\Http\Controllers\LoginController@choose')->name('login.choose');


Route::get('/event-form', fn() => view('event-form'));
Route::post('/google/event', 'App\Http\Controllers\GoogleCalendarController@addEvent')->name('teacher.addEvent');

Route::get('/ogretmen/{id}/detay', 'App\Http\Controllers\TeacherController@publicProfile')->name('teacher.public.profile');

Route::get('/oyunlar/carpan-avi',  fn() => view('games/carpan-avi'));



Route::get('/events/{id}/registrations', function ($id) {

    $event = Event::findOrFail($id);
    $attendees = $event->attendees;
    $count = count(array_filter(explode(',', $attendees)));

    /*if ($event->teacher_id != auth('teacher')->user()->id) {
        abort(403);
    }*/

    return response()->json(['count' => $count]);
});

Route::get('/teacher-events/{id}', function () {

    $teacherId = request()->id;

    $events = Event::where('teacher_id', $teacherId)->get();

    return $events;
});

Route::get('/events', 'App\Http\Controllers\EventsController@index')->middleware('auth:teacher')->name('teacher.events');
Route::get('/all-events', 'App\Http\Controllers\EventsController@allEvents')->middleware('auth:teacher')->name('all.events');
Route::get('/paid-events', 'App\Http\Controllers\EventsController@paidEvents')->middleware('auth:teacher')->name('paid.events');

Route::post('/events/store', 'App\Http\Controllers\EventsController@store')->middleware('auth:teacher')->name('event.save');
Route::post('/events/update', 'App\Http\Controllers\EventsController@update')->middleware('auth:teacher')->name('event.update');



Route::get('/time-debug', function () {
    return [
        'laravel_now' => now()->toDateTimeString(),
        'php_now' => date('Y-m-d H:i:s'),
        'php_timezone' => date_default_timezone_get(),
        'server_time' => shell_exec('date'),
    ];
});

// statistics route
Route::get('/statistics', 'App\Http\Controllers\HomeController@statistics')->name('statistics');
Route::get('/teacher-stats', 'App\Http\Controllers\HomeController@teacherStats')->name('teacher.stats');
Route::get('/quiz_list', 'App\Http\Controllers\QuizController@quiz_list')->name('quiz.list');
Route::get('/quiz/{id}', 'App\Http\Controllers\QuizController@quiz_show')->name('quiz.show');


Route::get('/kamplar', 'App\Http\Controllers\HomeController@campRegistration')->name('camp.registration');
Route::get('/ara-tatil-kamplar', 'App\Http\Controllers\HomeController@campsList')->name('camps.page');


//Exam Route
Route::get('/exam/{id}', 'App\Http\Controllers\ExamController@index')->name('exam.index');
Route::post('/exam/{exam_id}/submit-answers', 'App\Http\Controllers\ExamController@submitAnswers')->name('exam.submit_answers');



// Route for HomeController copyDB function
//Route::get('/copy-db', 'App\Http\Controllers\HomeController@copyDB')->name('copy.db');