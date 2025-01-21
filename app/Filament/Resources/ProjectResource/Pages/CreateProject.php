<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\WorkflowInstance;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    /**
     * Override the handleRecordCreation method to create a corresponding WorkflowInstance.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        // Create the project record first using the parent's method
        $project = parent::handleRecordCreation($data);

        // After the project is created, automatically create a WorkflowInstance.
        // Here, we're assuming the following:
        // - "workflow_template_id" is provided from the form.
        // - "status" for the new workflow instance is set to 'Not Started' or another default value.
        // - "current_stage_id" is set to null (or you can query the first stage from the chosen template, if desired).
        WorkflowInstance::create([
            'project_id' => $project->id,
            'workflow_template_id' => $data['workflow_template_id'],
            'status' => 'Not Started', // You can adjust this default as needed
            'current_stage_id' => null, // You can set this to the first stage ID if desired
            'started_at' => now(),
            // 'completed_at' is left null until the workflow is finished.
        ]);

        return $project;
    }
}
