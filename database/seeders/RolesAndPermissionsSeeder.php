<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles without 'guard_name'
        Role::firstOrCreate(
            ['name' => 'Managing Director'],
            ['description' => 'Manages the entire system']
        );

        Role::firstOrCreate(
            ['name' => 'Staff'],
            ['description' => 'Handles daily tasks and projects']
        );
    }
}
