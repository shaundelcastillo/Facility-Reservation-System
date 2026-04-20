<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // For the Admin Home/Overview (image_4bf37b.png)
    public function dashboard()
    {
        return view('admin.adminhome', [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'approved' => Reservation::where('status', 'approved')->count(),
            'totalFacilities' => Room::count(),
            // Fetches real pending requests for the "Pending Request" panel
            'pendingRequests' => Reservation::with(['user', 'room'])
                                ->where('status', 'pending')
                                ->orderBy('start_time', 'asc')
                                ->get()
        ]);
    }

    // For the Manage Reservations page (image_4bef63.png)
    public function reservations()
    {
        // Fetch all reservations with user and room details
        $reservations = Reservation::with(['user', 'room'])
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('admin.adminreservation', compact('reservations'));
    }

    // Function to handle the Approval/Rejection buttons
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status, // 'approved' or 'rejected'
            'approve_by' => auth()->id() // Tracks which admin approved it
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    } // This closes the updateStatus function

    // NOW the facilities function is properly inside the class
    public function facilities()
{
    // We name the variable $facilities so the Blade file can recognize it
    $facilities = \App\Models\Room::all();

    // Use 'facilities' as the string inside compact()
    return view('admin.adminfacilities', compact('facilities'));
}

} // THIS bracket must be at the very end of the file to close the Class