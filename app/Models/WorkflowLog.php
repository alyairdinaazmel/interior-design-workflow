<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowLog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'workflow_instance_id',
        'stage_id',
        'action',
        'comments',
        'timestamp',
    ];

    // Each log belongs to a workflow instance
    public function workflowInstance()
    {
        return $this->belongsTo(WorkflowInstance::class);
    }
    
    // Optionally, if the log references a stage
    public function stage()
    {
        return $this->belongsTo(WorkflowStage::class, 'stage_id');
    }
}
