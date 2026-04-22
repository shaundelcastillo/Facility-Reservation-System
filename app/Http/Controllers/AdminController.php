<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Stats for the top dashboard cards
        $total = Reservation::count();
        $pending = Reservation::where('status', 'pending')->count();
        $approved = Reservation::where('status', 'approved')->count();
        $totalFacilities = Room::count();

        // Fetches the Pending Requests table for the Admin Home view
        // Using latest() ensures that a student's new booking (like Room 309) appears immediately
        $pendingRequests = Reservation::with(['user', 'room'])
                            ->where('status', 'pending')
                            ->latest()
                            ->get();

        return view('admin.adminhome', compact('total', 'pending', 'approved', 'totalFacilities', 'pendingRequests'));
    }

    public function reservations()
    {
        $reservations = Reservation::with(['user', 'room'])
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('admin.adminreservation', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status, 
            'approve_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function facilities()
    {
        $facilities = Room::all();
        return view('admin.adminfacilities', compact('facilities'));
    }

    public function storeFacility(Request $request)
    {
        Room::create([
            'room_number' => $request->room_number,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'amenities' => $request->amenities,
            'is_available' => 'Yes'
        ]);

        return redirect()->back()->with('success', 'Facility added successfully!');
    }

    public function updateFacility(Request $request, $id)
    {
        $facility = Room::findOrFail($id); 
        
        $facility->update([
            'room_number' => $request->room_number,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'amenities'   => $request->amenities,
            'is_available' => $request->is_available ?? 'Yes',
        ]);

        return redirect()->back()->with('success', 'Facility updated!');
    }

    public function destroyFacility($id)
    {
        $facility = Room::findOrFail($id);
        $facility->delete();
        return redirect()->back()->with('success', 'Facility deleted!');
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation has been permanently deleted.');
    }
}