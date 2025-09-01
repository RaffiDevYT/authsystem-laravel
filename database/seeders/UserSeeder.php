<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user for email/password login
        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'phone_number' => '08123456789',
            'birth_day' => 15,
            'birth_month' => 1,
            'birth_year' => 1990,
            'gender' => 'male',
            'email_verified_at' => now(),
        ]);
    }
}
