<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin Account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@benedicto.edu.ph',
            'student_id' => '2026-00001',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // 2. Create Facilities from Screenshot
        Room::create([
            'room_number' => 'Room 301',
            'capacity' => 40,
            'description' => 'Standard classroom with modern facilities',
            'amenities' => 'PROJECTOR, WHITEBOARD, AIR CONDITION',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Room 309',
            'capacity' => 35,
            'description' => 'Spacious classroom for lectures and discussions',
            'amenities' => 'PROJECTOR, WHITEBOARD, AIR CONDITION',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Computer Lab 1',
            'capacity' => 30,
            'description' => 'Fully equipped computer laboratory with latest hardware',
            'amenities' => 'DESKTOP COMPUTERS, PROJECTOR, AIR CONDITION, WHITEBOARD',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Computer Lab 2',
            'capacity' => 30,
            'description' => 'Programming and development lab with specialized software',
            'amenities' => 'DESKTOP COMPUTERS, PROJECTOR, AIR CONDITION, WHITEBOARD',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Artist Hall',
            'capacity' => 200,
            'description' => 'Large multipurpose hall suitable for conferences, presentations, and ceremonies.',
            'amenities' => 'PROJECTOR, STAGE, SOUND SYSTEM',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Kenetics',
            'capacity' => 200,
            'description' => 'Large indoor gymnasium used for basketball, sports activities, and school events.',
            'amenities' => 'STAGE, BASKETBALL COURT, SOUND SYSTEM',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Library',
            'capacity' => 40,
            'description' => 'Quiet study space providing access to books, study tables, and computers.',
            'amenities' => 'TABLES, CHAIRS, DESKTOP COMPUTERS',
            'is_available' => 'Yes'
        ]);

        Room::create([
            'room_number' => 'Amphitheater',
            'capacity' => 40,
            'description' => 'Indoor lecture hall used for seminars, presentations, and academic gatherings.',
            'amenities' => 'PROJECTOR, SOUND SYSTEM, MICROPHONES',
            'is_available' => 'Yes'
        ]);
    }
}