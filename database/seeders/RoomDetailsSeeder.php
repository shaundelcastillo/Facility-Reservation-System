<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Remove Study Room 1 as requested
        Room::where('room_number', 'Study Room 1')->delete();

        // 2. Define the room data
        $rooms = [
            'Room 301' => [
                'desc' => 'Standard classroom with modern facilities',
                'tags' => 'Projector,Whiteboard,Air Condition',
                'cap' => 40
            ],
            'Room 309' => [
                'desc' => 'Spacious classroom for lectures and discussions',
                'tags' => 'Projector,Whiteboard,Air Condition',
                'cap' => 35
            ],
            'Computer Lab 1' => [
                'desc' => 'Fully equipped computer laboratory with latest hardware',
                'tags' => 'DESKTOP COMPUTERS,PROJECTOR,AIR CONDITION,WHITEBOARD',
                'cap' => 30
            ],
            'Computer Lab 2' => [
                'desc' => 'Programming and development lab with specialized software',
                'tags' => 'Desktop Computers,Projector,Air Condition,Whiteboard',
                'cap' => 30
            ],
            'Artist Hall' => [
                'desc' => 'Large multipurpose hall suitable for conferences, presentations, and ceremonies.',
                'tags' => 'Projector,Stage,Sound System',
                'cap' => 200
            ],
            'Kenetics' => [
                'desc' => 'Large indoor gymnasium used for basketball, sports activities, and school events.',
                'tags' => 'Stage,Basketball Court,Sound System',
                'cap' => 200
            ],
            'Library' => [
                'desc' => 'Quiet study space providing access to books, study tables, and computers.',
                'tags' => 'Tables,Chairs,Desktop Computers',
                'cap' => 40
            ],
            'Amphitheater' => [
                'desc' => 'Indoor lecture hall used for seminars, presentations, and academic gatherings.',
                'tags' => 'Projector,Sound System,Microphones',
                'cap' => 40
            ],
        ];

        // 3. Loop through and update each room in the database
        foreach ($rooms as $number => $data) {
            Room::where('room_number', $number)->update([
                'description' => $data['desc'],
                'amenities' => $data['tags'],
                'capacity' => $data['cap']
            ]);
        }
    }
}