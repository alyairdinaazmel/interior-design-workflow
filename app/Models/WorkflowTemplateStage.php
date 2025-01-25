<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowTemplateStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_template_id',
        'name',
        'order',
    ];

    // Relationship with WorkflowTemplate
    public function template()
{
    return $this->belongsTo(WorkflowTemplate::class, 'workflow_template_id');
}

public function tasks()
{
    return $this->hasMany(WorkflowTemplateTask::class, 'workflow_template_stage_id');
}

}
