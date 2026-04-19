<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('layout.facilities');
    }

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'facility_name' => 'required',
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'nullable|string',
        ]);

        // 2. Map Room Name to Room ID
        $room = Room::where('room_number', $request->facility_name)->first();

        if (!$room) {
            return redirect()->back()->with('error', 'Facility not found.');
        }

        // 3. Create the Reservation
        Reservation::create([
            'user_id'    => Auth::id(),
            'room_id'    => $room->room_id,
            'start_time' => $request->date . ' ' . $request->start_time,
            'end_time'   => $request->date . ' ' . $request->end_time,
            'purpose'    => $request->purpose,
            'status'     => 'pending', // Default for your future admin dashboard
        ]);

        // 4. Return with Success
        // Inside your store function in ReservationController.php
return redirect()->route('facilities')->with('success', 'Your reservation for ' . $request->facility_name . ' has been submitted!');
    }
}