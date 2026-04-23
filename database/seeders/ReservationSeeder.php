<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Get the Admin to assign as the approver
        $admin = User::where('role', 'admin')->first();

        $reservations = [
            [
                'name' => 'Juan Dela Cruz',
                'room' => 'Computer Lab 1',
                'date' => '2026-01-20',
                'start' => '09:00:00',
                'end' => '11:00:00',
                'purpose' => 'Web Development Workshop',
                'status' => 'Approved'
            ],
            [
                'name' => 'Maria Santos',
                'room' => 'Artist Hall',
                'date' => '2026-01-25',
                'start' => '14:00:00',
                'end' => '17:00:00',
                'purpose' => 'IT Symposium 2026',
                'status' => 'Pending'
            ],
            [
                'name' => 'Pedro Garcia',
                'room' => 'Amphitheater',
                'date' => '2026-01-18',
                'start' => '10:00:00',
                'end' => '12:00:00',
                'purpose' => 'Thesis Defense',
                'status' => 'Approved'
            ],
            [
                'name' => 'Anna Reyes',
                'room' => 'Computer Lab 2',
                'date' => '2026-01-23',
                'start' => '13:00:00',
                'end' => '15:00:00',
                'purpose' => 'Student Organization Meeting',
                'status' => 'Pending'
            ],
            [
                'name' => 'Carlos Mendoza',
                'room' => 'Kenetics',
                'date' => '2026-01-22',
                'start' => '15:00:00',
                'end' => '17:00:00',
                'purpose' => 'Group Study Session',
                'status' => 'Pending'
            ],
        ];

        foreach ($reservations as $data) {
            $user = User::where('name', $data['name'])->first();
            $room = Room::where('room_number', $data['room'])->first();

            if ($user && $room) {
                Reservation::create([
                    'user_id' => $user->user_id,
                    'room_id' => $room->room_id,
                    'start_time' => $data['date'] . ' ' . $data['start'],
                    'end_time' => $data['date'] . ' ' . $data['end'],
                    'purpose' => $data['purpose'],
                    'status' => $data['status'],
                    // If approved, set the admin ID using the fix we made in MySQL
                    'approve_by' => ($data['status'] === 'Approved') ? $admin->user_id : null,
                ]);
            }
        }
    }
}