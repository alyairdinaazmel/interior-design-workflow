<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles using Spatie's Role model.
        // Only insert 'name' and 'guard_name' as these are the columns present.
        Role::firstOrCreate(
            ['name' => 'Managing Director', 'guard_name' => 'web']
        );

        Role::firstOrCreate(
            ['name' => 'Staff', 'guard_name' => 'web']
        );
    }
}
