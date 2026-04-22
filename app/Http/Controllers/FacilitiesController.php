<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    // 1. DISPLAY (READ) - Already in your code
    public function index()
    {
        $facilities = Room::all();
        $globalBookings = Reservation::where('status', 'approved')->with('user')->get();
        return view('layout.facilities', compact('facilities', 'globalBookings'));
    }

    // 2. CREATE - This makes the "Add Facility" button work
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
        ]);

        Room::create($request->all());

        return redirect()->back()->with('success', 'Facility added successfully!');
    }

    // 3. UPDATE - This makes the "Edit" button work
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,'.$id.',room_id',
            'capacity' => 'required|integer',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->back()->with('success', 'Facility updated successfully!');
    }

    // 4. DELETE - This makes the red trash icon work
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        
        // Optional: Delete associated reservations first to avoid database errors
        Reservation::where('room_id', $id)->delete();
        
        $room->delete();

        return redirect()->back()->with('success', 'Facility deleted successfully!');
    }
}