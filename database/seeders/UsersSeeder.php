<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Creating a Managing Director
        User::firstOrCreate(
            ['email' => 'director@example.com'],
            [
                'name' => 'Adam Pauzi',
                'password' => Hash::make('password'), // Use a secure password in production
                'role' => 'Managing Director',
                'contact' => '123-456-7890',
                'specific_role' => 'Managing Director',
            ]
        );

        // Creating Staff Users
        User::firstOrCreate(
            ['email' => 'designer@example.com'],
            [
                'name' => 'Siti Sofea',
                'password' => Hash::make('password'),
                'role' => 'Staff',
                'contact' => '234-567-8901',
                'specific_role' => 'Designer',
            ]
        );

        User::firstOrCreate(
            ['email' => 'sales@example.com'],
            [
                'name' => 'Siti Khodijah',
                'password' => Hash::make('password'),
                'role' => 'Staff',
                'contact' => '345-678-9012',
                'specific_role' => 'Sales Manager',
            ]
        );
    }
}
