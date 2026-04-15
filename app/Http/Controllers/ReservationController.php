<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'nullable|string',
        ]);

        // 2. Logic to save to database would go here (e.g., Reservation::create($validated);)

        // 3. Redirect back with a success message
        return redirect()->back()->with('success', 'Your reservation has been submitted!');
    }
}