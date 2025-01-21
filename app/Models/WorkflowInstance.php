<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowInstance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_id',
        'workflow_template_id',
        'status',
        'current_stage_id',
        'started_at',
        'completed_at',
    ];

    // A workflow instance belongs to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    // It is created from a workflow template
    public function workflowTemplate()
    {
        return $this->belongsTo(WorkflowTemplate::class);
    }
    
    // The current stage (using current_stage_id)
    public function currentStage()
    {
        return $this->belongsTo(WorkflowStage::class, 'current_stage_id');
    }
    
    // A workflow instance can have many logs
    public function workflowLogs()
    {
        return $this->hasMany(WorkflowLog::class);
    }

    // A workflow instance can contain many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
