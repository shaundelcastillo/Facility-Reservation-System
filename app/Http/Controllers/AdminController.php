<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Facility;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Renders the actual Blade Pages
    public function dashboard() { return view('admin.adminhome'); }
    public function reservations() { return view('admin.adminreservation'); }
    public function facilities() 
{ 
    // Fetch all facilities from the database
    $facilities = Facility::all(); 
    
    // Pass the variable to the view
    return view('admin.adminfacilities', compact('facilities')); 
}

    // API: Fetch Data for Dashboard Stats & Pending List
    public function getDashboardData()
    {
        return response()->json([
            'total' => Reservation::count(),
            'pending_count' => Reservation::where('status', 'pending')->count(),
            'approved' => Reservation::where('status', 'approved')->count(),
            'facilities_count' => Facility::count(),
            'pending_list' => Reservation::with(['user', 'facility'])
                                ->where('status', 'pending')
                                ->latest()->get()
        ]);
    }

    // API: Fetch All Reservations
    public function getAllReservations()
    {
        // 'with' ensures we get names from related tables
        $data = Reservation::with(['user', 'facility'])->get();
        return response()->json($data);
    }

    // API: Handle the Approve/Reject Action
    public function updateStatus(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $reservation->status = $request->status; // 'approved' or 'rejected'
        $reservation->save();

        return response()->json(['success' => true]);
    }
}