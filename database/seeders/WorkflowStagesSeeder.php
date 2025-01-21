<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowStage;

class WorkflowStagesSeeder extends Seeder
{
    public function run()
    {
        // Assuming WorkflowTemplate with ID 1 exists
        WorkflowStage::create([
            'workflow_template_id' => 1,
            'name'  => 'Initial Consultation',
            'order' => 1,
        ]);

        WorkflowStage::create([
            'workflow_template_id' => 1,
            'name'  => 'Design Drafting',
            'order' => 2,
        ]);

        WorkflowStage::create([
            'workflow_template_id' => 1,
            'name'  => 'Client Approval',
            'order' => 3,
        ]);

        WorkflowStage::create([
            'workflow_template_id' => 1,
            'name'  => 'Implementation',
            'order' => 4,
        ]);

        WorkflowStage::create([
            'workflow_template_id' => 1,
            'name'  => 'Final Review',
            'order' => 5,
        ]);
    }
}
