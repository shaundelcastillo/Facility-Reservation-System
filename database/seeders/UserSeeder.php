<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // The Admin - matching your exact requirement
        User::updateOrCreate(
            ['student_id' => '2026-00001'], // Search by ID to prevent duplicates
            [
                'name' => 'Admin User',
                'email' => 'admin@benedicto.edu.ph',
                'password' => Hash::make('admin123'), // Your preferred password
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // Add the students for your UI/UX list
        $students = [
            ['name' => 'Juan Dela Cruz', 'id' => '2026-00002', 'email' => 'juan@example.com'],
            ['name' => 'Maria Santos', 'id' => '2026-00003', 'email' => 'maria@example.com'],
        ];

        foreach ($students as $s) {
            User::updateOrCreate(
                ['student_id' => $s['id']],
                [
                    'name' => $s['name'],
                    'email' => $s['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'student',
                    'status' => 'active',
                ]
            );
        }
    }
}