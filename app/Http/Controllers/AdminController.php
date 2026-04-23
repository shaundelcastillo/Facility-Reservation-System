<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Added this line

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Reservation::count();
        $pending = Reservation::where('status', 'pending')->count();
        $approved = Reservation::where('status', 'approved')->count();
        $totalFacilities = Room::count();

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
        
        $reservation->status = $request->status;
        
        if ($request->status == 'approved') {
            $reservation->approve_by = Auth::id(); 
        }
        
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation updated successfully!');
    }

    public function facilities()
    {
        $facilities = Room::all();
        return view('admin.adminfacilities', compact('facilities'));
    }

    public function storeFacility(Request $request)
    {
        Room::create([
            'name'        => $request->room_number, 
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'amenities'   => $request->amenities,
            'status'      => 'available' 
        ]);

        return redirect()->back()->with('success', 'Facility added successfully!');
    }

    public function updateFacility(Request $request, $id)
    {
        $facility = Room::findOrFail($id); 
        
        $facility->update([
            'name'        => $request->room_number, 
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'amenities'   => $request->amenities,
            'status'      => $request->is_available ?? 'available', 
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