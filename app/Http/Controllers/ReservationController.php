<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**

     * Reflects ALL bookings so users know which dates are taken.
     */
    public function showCalendar(Request $request)
    {
        $monthQuery = $request->get('month');
        $date = $monthQuery ? Carbon::parse($monthQuery) : Carbon::now();
        
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        
        // FIX: Fetch both 'approved' and 'pending' reservations 
        // so users see a slot is already "taken" or "requested"
        $reservations = Reservation::whereIn('status', ['approved', 'pending'])
            ->whereBetween('start_time', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->start_time)->format('j'); 
            });

        return view('user.calendar', [
            'date' => $date,
            'daysInMonth' => $date->daysInMonth,
            'startOfWeek' => $startOfMonth->dayOfWeek, 
            'reservations' => $reservations
        ]);
    }

    /**
     * Handle the booking submission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required',
            'date'       => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time',
            'purpose'    => 'required|string|max:255',
        ]);

        // Change 'room_number' to 'name' to match your database
        $room = Room::where('name', trim($request->facility_name))->first();

// 2. Strict Check: If the room is not found, stop here and show an error
if (!$room) {
    return redirect()->back()
        ->with('error', 'Facility "' . $request->facility_name . '" was not found in our records.')
        ->withInput(); // This keeps the student's data in the form so they don't have to re-type it
}

// 3. Now it is safe to create the reservation because we know $room->id exists
Reservation::create([
    'user_id'    => Auth::id(),
    'room_id'    => $room->id, // Changed from room_id to id based on standard Room models
    'start_time' => $request->date . ' ' . $request->start_time,
    'end_time'   => $request->date . ' ' . $request->end_time,
    'purpose'    => $request->purpose,
    'status'     => 'pending',
]);

        return redirect()->route('dashboard')->with('success', 'Reservation submitted successfully!');
    }

    /**
     * Cancel/Delete a reservation.
     */
    public function destroy($id)
    {
        $reservation = Reservation::where('reservation_id', $id) 
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $reservation->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Reservation cancelled successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Reservation cancelled.');
    }

    
    public function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->get();

        return view('user.reservation', compact('reservations')); 
    }
}