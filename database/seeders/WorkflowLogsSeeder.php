<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowLog;

class WorkflowLogsSeeder extends Seeder
{
    public function run()
    {
        WorkflowLog::create([
            'workflow_instance_id' => 1,
            'stage_id'             => 1, // Assuming stage 1 is "Initial Consultation"
            'action'               => 'Stage Completed',
            'comments'             => 'Initial consultation completed successfully.',
            'timestamp'            => now(),
        ]);

        WorkflowLog::create([
            'workflow_instance_id' => 1,
            'stage_id'             => 2, // "Design Drafting"
            'action'               => 'Stage Started',
            'comments'             => 'Design drafting has begun.',
            'timestamp'            => now(),
        ]);
    }
}
