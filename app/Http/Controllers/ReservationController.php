<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Added this import

class ReservationController extends Controller
{
    /**
     * Show the facilities page.
     */
    public function index()
    {
        return view('layout.facilities');
    }

    /**
     * Show the logged-in user's reservations.
     */
    public function myReservations()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('start_time', 'desc')
            ->get();

        return view('layout.reservation', compact('reservations'));
    }

    /**
     * Show the dynamic reservation calendar.
     */
    public function showCalendar(Request $request)
    {
        // Get the month from the URL or default to current month
        $monthQuery = $request->get('month');
        $date = $monthQuery ? Carbon::parse($monthQuery) : Carbon::now();
        
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        
        // Fetch real reservations for the school facility system
        $reservations = Reservation::whereBetween('start_time', [$startOfMonth, $endOfMonth])
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
     * Store a new reservation in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required',
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'purpose' => 'nullable|string',
        ]);

        $room = Room::where('room_number', $request->facility_name)->first();

        if (!$room) {
            return redirect()->back()->with('error', 'Facility not found.');
        }

        Reservation::create([
            'user_id'    => Auth::id(),
            'room_id'    => $room->room_id,
            'start_time' => $request->date . ' ' . $request->start_time,
            'end_time'   => $request->date . ' ' . $request->end_time,
            'purpose'    => $request->purpose,
            'status'     => 'pending', 
        ]);

        return redirect()->route('facilities')->with('success', 'Your reservation for ' . $request->facility_name . ' has been submitted!');
    }

    public function destroy($id)
{
    // Change 'id' to 'reservation_id' to match your database
    $reservation = Reservation::where('reservation_id', $id) 
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $reservation->delete();
    return response()->json(['success' => true, 'message' => 'Reservation cancelled.']);
}
}