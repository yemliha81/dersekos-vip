<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Event;


class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('admin.login.login'); // resources/views/auth/login.blade.php
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        //dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('admin'); // redirect to admin dashboard
        }

        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $freeEventCount = Event::where('is_free', 1)->count();
        $paidEventCount = Event::where('is_free', 0)->count();

        return view('admin.dashboard', compact('studentCount', 'teacherCount', 'freeEventCount', 'paidEventCount'));
    }

    /**
     * Logout user.
     */
    public function logout()
    {
        Auth::logout();
        

        return redirect('/admin/login');
    }
}
