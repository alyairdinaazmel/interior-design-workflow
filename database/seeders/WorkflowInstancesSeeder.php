<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowInstance;
use App\Models\WorkflowStage;

class WorkflowInstancesSeeder extends Seeder
{
    public function run()
    {
        // Find the first workflow stage (lowest order) for template with ID 1.
        $firstStage = WorkflowStage::where('workflow_template_id', 1)
            ->orderBy('order', 'asc')
            ->first();

        WorkflowInstance::create([
            'project_id'           => 1, // For project "Modern Living Room"
            'workflow_template_id' => 1,
            'status'               => 'Not Started',
            'current_stage_id'     => $firstStage ? $firstStage->id : null,
            'started_at'           => now(),
            'completed_at'         => null,
        ]);
    }
}
