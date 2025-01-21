<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkflowTemplate;

class WorkflowTemplatesSeeder extends Seeder
{
    public function run()
    {
        WorkflowTemplate::create([
            'name' => 'Standard Project Workflow',
            'description' => 'A standard workflow for all interior design projects.',
        ]);
    }
}
