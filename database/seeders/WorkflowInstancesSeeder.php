<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowInstance;

class WorkflowInstancesSeeder extends Seeder
{
    public function run()
    {
        WorkflowInstance::create([
            'project_id' => 1, // Modern Living Room
            'workflow_template_id' => 1,
            'status' => 'In Progress',
            'current_stage_id' => 2, // Design Drafting
            'started_at' => now(),
            'completed_at' => null,
        ]);
    }
}
