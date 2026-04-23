<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $facilities = Room::all();
        $globalBookings = Reservation::where('status', 'approved')->with('user')->get();
        return view('layout.facilities', compact('facilities', 'globalBookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:facilities,name', // Matches your DB 'name' column
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
        ]);

        Room::create($request->all());

        return redirect()->back()->with('success', 'Facility added successfully!');
    }

    public function update(Request $request, $id)
    {
        // FIX: Added 'description' and 'amenities' to validation so they aren't ignored
        $request->validate([
            'room_number' => 'required', 
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
        ]);

        $room = Room::findOrFail($id);
        
        // This will now include description and amenities because they are validated
        $room->update($request->all());

        return redirect()->back()->with('success', 'Facility updated successfully!');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        Reservation::where('room_id', $id)->delete();
        $room->delete();

        return redirect()->back()->with('success', 'Facility deleted successfully!');
    }
}