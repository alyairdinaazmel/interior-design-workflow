<?php

namespace App\Http\Controllers;

use App\Models\WorkflowInstance;
use App\Models\WorkflowStage;
use App\Models\WorkflowTemplate;
use App\Models\Task;
use Illuminate\Http\Request;

class WorkflowInstanceController extends Controller
{
    /**
     * Create a new workflow instance and copy tasks from the template.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWorkflowInstance(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'workflow_template_id' => 'required|exists:workflow_templates,id',
        ]);

        // Fetch the workflow template
        $workflowTemplate = WorkflowTemplate::with('stages.templateTasks')->findOrFail($validated['workflow_template_id']);

        // Create a new workflow instance
        $workflowInstance = WorkflowInstance::create([
            'project_id' => $validated['project_id'],
            'workflow_template_id' => $workflowTemplate->id,
            'status' => 'Not Started',
            'current_stage_id' => $workflowTemplate->stages->first()?->id, // Set the first stage as the current stage
            'started_at' => now(),
        ]);

        // Copy tasks from the workflow template stages into the `tasks` table
        foreach ($workflowTemplate->stages as $stage) {
            foreach ($stage->templateTasks as $templateTask) {
                Task::create([
                    'workflow_instance_id' => $workflowInstance->id,
                    'workflow_stage_id' => $stage->id, // Associate with the workflow stage
                    'title' => $templateTask->title,
                    'description' => $templateTask->description,
                    'status' => 'Pending', // Default status for new tasks
                    // Optional: You can add start_date and deadline if required
                ]);
            }
        }

        return response()->json([
            'message' => 'Workflow instance created successfully.',
            'workflow_instance' => $workflowInstance,
        ]);
    }
}
