<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('layout.forgotpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // 1. Check if the email exists in your users table
        $request->validate(['email' => 'required|email|exists:users,email']);

        // 2. Generate a random 8-character password
        $newPassword = Str::random(8);

        // 3. Update the user's password in the database (Must be hashed!)
        DB::table('users')->where('email', $request->email)->update([
            'password' => bcrypt($newPassword)
        ]);

        // 4. Send the Gmail
        $emailData = ['password' => $newPassword];
        
        Mail::send([], [], function ($message) use ($request, $newPassword) {
            $message->to($request->email)
                ->subject('Your New Password - Facility Reservation System')
                // This is the raw text of the email
                ->html("
                    <h3>Benedicto College</h3>
                    <p>Your password has been reset. Please use the temporary password below to log in:</p>
                    <p><strong>New Password:</strong> {$newPassword}</p>
                    <p>We recommend changing this password immediately after you log in.</p>
                ");
        });

        return back()->with('status', 'A new password has been sent to your Gmail inbox!');
    }
}