<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'client_id',
        'budget',
        'workflow_template_id',
        'start_date',
        'end_date',
        'status',
        'project_description',
        'project_type_id',
        // Add other fillable fields as necessary
    ];

    // Each project belongs to one client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // A project can have one workflow instance (if the relationship is one-to-one)
    public function workflowInstance()
    {
        return $this->hasOne(WorkflowInstance::class);
    }

    // Optionally, if you link tasks directly to projects
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Get the workflow template associated with the project
    public function workflowTemplate()
    {
        return $this->belongsTo(WorkflowTemplate::class, workflow_template_id);
    }

    // Each project belongs to a project type
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

}
