<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    // After successfully resetting, send them back to login
    protected $redirectTo = '/login';

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('layout.resetpassword')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}