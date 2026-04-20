<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validate the incoming request
        $request->validate([
            'student_id' => ['required'],
            'password' => ['required'],
        ]);

        // 2. Attempt login using student_id instead of email
        // Auth::attempt will look for the 'student_id' column in your users table
        if (Auth::attempt(['student_id' => $request->student_id, 'password' => $request->password])) {
            $request->session()->regenerate();

            // 3. Redirect based on role
            if (Auth::user()->role === 'admin') {
                // Ensure 'admin.home' exists in your web.php
                return redirect()->intended(route('admin.home'));
            }

            return redirect()->intended(route('dashboard'));
        }

        // 4. If login fails, return with error message
        return back()->withErrors([
            'student_id' => 'The provided School ID or password does not match our records.',
        ])->onlyInput('student_id'); 
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}