<?php
//insert Admin/MenuController
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\SeederController;

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
Route::get('/student/old-lessons', 'App\Http\Controllers\StudentController@oldEvents')->middleware('auth:student')->name('student.old_lessons');
Route::post('/student/event-rate', 'App\Http\Controllers\StudentController@rateEvent')->middleware('auth:student')->name('student.event_rate');
Route::post('/student/join-free-lesson/{id}', 'App\Http\Controllers\StudentController@joinToEvent')->middleware('auth:student')->name('student.join_free_lesson');

// cart routes
Route::get('/sepetim', 'App\Http\Controllers\CartController@index')->name('student.cart.index');
Route::post('/cart/add', 'App\Http\Controllers\CartController@addToCart')->name('student.cart.add');
Route::post('/cart/remove', 'App\Http\Controllers\CartController@removeFromCart')->name('student.cart.remove');
Route::get('/cart/empty', 'App\Http\Controllers\CartController@emptyCart')->name('student.cart.empty');


// teacher routes
Route::get('/teacher/dashboard', 'App\Http\Controllers\TeacherController@dashboard')->middleware('auth:teacher')->name('teacher.dashboard');
Route::get('/ogretmen/giris', 'App\Http\Controllers\TeacherController@showLoginForm')->name('teacher.login');
Route::post('/ogretmen/giris', 'App\Http\Controllers\TeacherController@login')->name('teacher.login.submit');
Route::post('/ogretmen/kayit', 'App\Http\Controllers\TeacherController@signup')->name('teacher.signup.submit');
Route::post('/ogretmen/profil/duzenle', 'App\Http\Controllers\TeacherController@updateProfile')->middleware('auth:teacher')->name('teacher.profile.update');

Route::get('/teacher/dashboard', 'App\Http\Controllers\TeacherController@dashboard')->middleware('auth:teacher')->name('teacher.dashboard');
//Route::get('/ogretmenler', 'App\Http\Controllers\TeacherController@listTeachers')->middleware('auth:student')->name('teacher.list');
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

// VIP Packages route
Route::get('/vip-paketler', 'App\Http\Controllers\HomeController@vipPackages')->name('vip.packages');
// VIP package purchase route
Route::get('/vip-paketler/satin-al/{id}', 'App\Http\Controllers\HomeController@purchaseVipPackage')->name('vip.package.purchase');
//vip.package.purchase.post
Route::post('/vip-paketler/satin-al', 'App\Http\Controllers\HomeController@purchaseVipPackagePost')->name('vip.package.purchase.post');

// about route
Route::get('/hakkimizda', 'App\Http\Controllers\HomeController@about')->name('about');
//contact route
Route::get('/iletisim', 'App\Http\Controllers\HomeController@contact')->name('contact.page');

//iade page
Route::get('/teslimat-iade', 'App\Http\Controllers\HomeController@refund')->name('refund.page');

// privacy page
Route::get('/gizlilik-politikasi', 'App\Http\Controllers\HomeController@privacy')->name('privacy.page');
// contract page
Route::get('/mesafeli-satis-sozlesmesi', 'App\Http\Controllers\HomeController@contract')->name('contract.page');

Route::get('/ogretmenler', 'App\Http\Controllers\HomeController@teachersList')->name('teachers.list');





// Route for HomeController copyDB function
//Route::get('/copy-db', 'App\Http\Controllers\HomeController@copyDB')->name('copy.db');