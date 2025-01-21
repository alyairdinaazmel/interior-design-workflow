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
        'start_date',
        'end_date',
        'status',
        'project_description',
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

    public function workflowTemplate()
{
    return $this->belongsTo(WorkflowTemplate::class);
}

}
