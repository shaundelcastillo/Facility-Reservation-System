<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\RoomType;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure the Main Building exists
        $building = Building::updateOrCreate(
            ['building_id' => 1],
            ['building_name' => 'Main Building', 'location' => 'Mandaue Campus']
        );

        // 2. Create the Room Types based on your CSS classes
        $types = [
            1 => 'Classroom',
            2 => 'Computer Lab',
            3 => 'Conference Room',
            4 => 'Auditorium'
        ];

        foreach ($types as $id => $name) {
            RoomType::updateOrCreate(['roomtype_id' => $id], ['type_name' => $name]);
        }

        // 3. The 8 Facilities from your HTML
        $facilities = [
            ['room_number' => 'Room 301', 'capacity' => 40, 'type' => 1, 'location' => 'Floor 3'],
            ['room_number' => 'Room 309', 'capacity' => 35, 'type' => 1, 'location' => 'Floor 3'],
            ['room_number' => 'Computer Lab 1', 'capacity' => 30, 'type' => 2, 'location' => 'Floor 3'],
            ['room_number' => 'Computer Lab 2', 'capacity' => 30, 'type' => 2, 'location' => 'Floor 3'],
            ['room_number' => 'Artist Hall', 'capacity' => 200, 'type' => 3, 'location' => 'Floor 3'],
            ['room_number' => 'Kenetics', 'capacity' => 200, 'type' => 3, 'location' => 'Floor 4'],
            ['room_number' => 'Library', 'capacity' => 40, 'type' => 4, 'location' => 'Floor 3'],
            ['room_number' => 'Amphitheater', 'capacity' => 80, 'type' => 4, 'location' => 'Floor 3'],
        ];

        foreach ($facilities as $facility) {
            Room::updateOrCreate(
                ['room_number' => $facility['room_number']],
                [
                    'capacity' => $facility['capacity'],
                    'building_id' => $building->building_id,
                    'roomtype_id' => $facility['type'],
                    'is_available' => 'Yes'
                ]
            );
        }
    }
}