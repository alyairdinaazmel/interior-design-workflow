<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'workflow_instance_id' => 1,
            'title' => 'Initial Consultation Meeting',
            'description' => 'Meet with the client to discuss their needs and preferences.',
            'assigned_to' => 2, // Jane Smith (Designer)
            'start_date' => '2025-02-01',
            'deadline' => '2025-02-05',
            'status' => 'Completed',
        ]);

        Task::create([
            'workflow_instance_id' => 1,
            'title' => 'Create Design Drafts',
            'description' => 'Develop initial design drafts based on client consultation.',
            'assigned_to' => 2,
            'start_date' => '2025-02-06',
            'deadline' => '2025-02-20',
            'status' => 'In Progress',
        ]);
    }
}
