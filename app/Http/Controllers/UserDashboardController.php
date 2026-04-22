<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Consistent counts for the logged-in student
        $total = Reservation::where('user_id', $userId)->count();
        $pending = Reservation::where('user_id', $userId)->where('status', 'pending')->count();
        $approved = Reservation::where('user_id', $userId)->where('status', 'approved')->count();

        // Fetch the absolute latest reservation (even if pending) to show on the dashboard card
        $recentReservation = Reservation::where('user_id', $userId)
            ->with('room')
            ->latest()
            ->first();

        return view('user.dashboard', compact('total', 'pending', 'approved', 'recentReservation'));
    }
}