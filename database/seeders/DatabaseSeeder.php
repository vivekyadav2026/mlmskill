<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Course
        \App\Models\Course::create([
            'title' => 'Advanced Skill Development Course',
            'description' => 'Learn the best skills required for the market.',
            'price' => 300.00,
            'status' => 'active',
        ]);
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'referral_code' => 'ADMIN123',
        ]); 

        // Regular user
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'inactive',
            'referral_code' => 'USER456',
            'sponsor_id' => 'ADMIN123',
        ]);
    }
}
