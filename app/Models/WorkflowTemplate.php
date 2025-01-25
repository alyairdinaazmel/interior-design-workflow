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
}
