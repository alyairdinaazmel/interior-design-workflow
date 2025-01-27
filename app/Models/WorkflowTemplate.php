<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowTemplate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
    ];

    // A workflow template has many workflow stages
    public function stages()
    {
        return $this->hasMany(WorkflowTemplateStage::class, 'workflow_template_id');
    }    

    // It can also be used for many workflow instances
    public function workflowInstances()
    {
        return $this->hasMany(WorkflowInstance::class);
    }

    // Define a hasManyThrough relationship to count tasks across all stages
    public function tasks()
    {
        return $this->hasManyThrough(
            WorkflowTemplateTask::class, // Target model
            WorkflowTemplateStage::class, // Intermediate model
            'workflow_template_id', // Foreign key on WorkflowTemplateStage
            'workflow_template_stage_id',   // Foreign key on WorkflowTemplateTask
            'id',                  // Local key on WorkflowTemplate
            'id'                   // Local key on WorkflowTemplateStage
        );
    }
}

