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
     * Show the dynamic reservation calendar.
     * Reflects ALL bookings so users know which dates are taken.
     */
    public function showCalendar(Request $request)
    {
        $monthQuery = $request->get('month');
        $date = $monthQuery ? Carbon::parse($monthQuery) : Carbon::now();
        
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        
        // FIX: Fetch both 'approved' and 'pending' reservations 
        // so users see that a slot is already "taken" or "requested"
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

        $room = Room::where('room_number', $request->facility_name)->first();

        if (!$room) {
            return redirect()->back()->with('error', 'Facility not found in database.');
        }

        Reservation::create([
            'user_id'    => Auth::id(), 
            'room_id'    => $room->room_id,
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

    /**
     * Display a listing of personal reservations.
     */
    public function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->get();

        return view('user.reservation', compact('reservations')); 
    }
}