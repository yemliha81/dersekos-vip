<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        
        return view('login');
    }

    public function choose(){
        return view('login-choose');
    }

     public function login(Request $request)
    {
        //dd($request->all());
        try {
           
        // Validate the login form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (auth('student')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('student.dashboard');
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function signup(Request $request)
    {
        //dd($request->all());
        try {
       
            // ✅ Validate input
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:student',
                'password' => 'required|string|min:6',
                'grade'    => 'required|string|max:50',
            ]);

            // ✅ Create student
            $student = Student::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'grade'    => $request->grade,
                'address' =>  $request->ip()
            ]);

            // ✅ Log them in using student guard
            Auth::guard('student')->login($student);

            return redirect()->route('student.dashboard');
        
         } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function logout()
    {
        auth('student')->logout();
        return redirect('/giris');
    }
}
