<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'student_id' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.home'));
            }

            // FIXED: Using 'dashboard' because your route:list shows the name is 'dashboard'
            return redirect()->intended(route('dashboard'));
        }

        // This closing bracket was missing, which caused the red line!
        return back()->withErrors([
            'student_id' => 'The provided credentials do not match our records.',
        ]);     
    }
}