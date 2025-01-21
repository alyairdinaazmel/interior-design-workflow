<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDocument extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'task_id',
        'file_path',
        'file_name',
        'uploaded_by',
    ];

    // Each document belongs to a task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // And each document is uploaded by a user
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
