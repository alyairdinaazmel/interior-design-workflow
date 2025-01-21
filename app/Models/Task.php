<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'workflow_instance_id',
        'title',
        'description',
        'assigned_to',
        'start_date',
        'deadline',
        'status',
    ];

    // Each task belongs to a workflow instance
    public function workflowInstance()
    {
        return $this->belongsTo(WorkflowInstance::class);
    }

    // Each task belongs to a workflow stage
    public function stage()
    {
        return $this->belongsTo(WorkflowStage::class);
    }

    // Task is assigned to a user
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // A task can have many comments
    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    // A task can have many documents
    public function documents()
    {
        return $this->hasMany(TaskDocument::class);
    }
}
