<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'Modern Living Room',
            'client_id' => 1, // Acme Corp
            'budget' => 15000.00,
            'start_date' => '2025-02-01',
            'end_date' => '2025-04-30',
            'status' => 'In Progress',
            'project_description' => 'A complete makeover of a 3-bedroom living room with modern aesthetics.',
        ]);

        Project::create([
            'name' => 'Office Space Renovation',
            'client_id' => 2, // Global Enterprises
            'budget' => 30000.00,
            'start_date' => '2025-03-15',
            'end_date' => '2025-06-15',
            'status' => 'Not Started',
            'project_description' => 'Renovation of a 5-story office building to enhance workspace functionality.',
        ]);
    }
}
