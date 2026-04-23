<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility; 
use Illuminate\Support\Facades\Schema; 

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Schema::disableForeignKeyConstraints();
        Facility::truncate();
        Schema::enableForeignKeyConstraints();

        
        Facility::insert([
            [
                'name' => 'Room 301',
                'description' => 'Standard classroom with modern facilities',
                'capacity' => 40,
                'amenities' => 'PROJECTOR, WHITEBOARD, AIR CONDITION'
            ],
            [
                'name' => 'Room 309',
                'description' => 'Spacious classroom ideal for lectures and group activities',
                'capacity' => 35,
                'amenities' => 'PROJECTOR, WHITEBOARD, AIR CONDITION'
            ],
            [
                'name' => 'Computer Lab 1',
                'description' => 'Fully equipped computer laboratory with latest hardware',
                'capacity' => 30,
                'amenities' => 'DESKTOP COMPUTERS, PROJECTOR, AIR CONDITION, WHITEBOARD'
            ],
            [
                'name' => 'Computer Lab 2',
                'description' => 'Programming and development lab with specialized software',
                'capacity' => 30,
                'amenities' => 'DESKTOP COMPUTERS, PROJECTOR, AIR CONDITION, WHITEBOARD'
            ],
            [
                'name' => 'Artist Hall',
                'description' => 'Large multipurpose hall suitable for conferences, presentations, and ceremonies',
                'capacity' => 200,
                'amenities' => 'STAGE, SOUND SYSTEM, LIGHTING, PROJECTOR, AIR CONDITION'
            ],
            [
                'name' => 'Kenetics',
                'description' => 'Large indoor gymnasium used for basketball, sports activities, and school events.',
                'capacity' => 200,
                'amenities' => 'STAGE, BASKETBALL COURT, SOUND SYSTEM'
            ],
            [
                'name' => 'Library',
                'description' => 'Quiet study space providing access to books, study tables, and computers.',
                'capacity' => 40,
                'amenities' => 'BOOKSHELVES, STUDY TABLES, AIR CONDITION, DESKTOP COMPUTERS'
            ],
            [
                'name' => 'Amphitheater',
                'description' => 'Indoor lecture hall used for seminars, presentations, and academic gatherings.',
                'capacity' => 80,
                'amenities' => 'SOUND SYSTEM, PROJECTOR, AIR CONDITION'
            ]
        ]);
    }
}