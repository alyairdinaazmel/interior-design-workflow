<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\WorkflowStage;
use App\Models\WorkflowInstance;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    /**
     * Override the handleRecordCreation method
     * to automatically create a WorkflowInstance after the project is created.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        // Create the project using the parent's record creation method.
        $project = parent::handleRecordCreation($data);

        // Retrieve the first workflow stage for the selected workflow template.
        $firstStage = WorkflowStage::where('workflow_template_id', $data['workflow_template_id'])
            ->orderBy('order', 'asc')
            ->first();

        if (!$firstStage) {
            // If no stage is found, you can either throw an exception,
            // or handle the case by notifying the user that the template is incomplete.
            throw new \Exception('No stages defined for the selected workflow template. Please define at least one stage before creating a project.');
        }

        // Automatically create a WorkflowInstance with the first stage set.
        WorkflowInstance::create([
            'project_id'            => $project->id,
            'workflow_template_id'  => $data['workflow_template_id'],
            'status'                => 'Not Started', // you may change to a desired default status.
            'current_stage_id'      => $firstStage->id,
            'started_at'            => now(),
            // 'completed_at' remains null until the workflow is finished.
        ]);

        return $project;
    }
}
