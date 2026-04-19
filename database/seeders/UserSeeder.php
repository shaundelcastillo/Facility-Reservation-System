<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // The Admin
        User::create([
            'name' => 'Admin User',
            'student_id' => 'ADMIN-01',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'course' => 'Staff',
        ]);

        // The Student/User
        User::create([
            'name' => 'Student User',
            'student_id' => '2026-00057',
            'email' => 'student@example.com',
            'password' => Hash::make('student123'),
            'role' => 'student',
            'course' => 'BSIT',
        ]);
    }
}