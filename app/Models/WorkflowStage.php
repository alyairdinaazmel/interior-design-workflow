<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowStage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'workflow_template_id',
        'name',
        'order',
    ];

    // Each stage belongs to a workflow template
    public function workflowTemplate()
    {
        return $this->belongsTo(WorkflowTemplate::class);
    }
}
