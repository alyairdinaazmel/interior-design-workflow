<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
    ];

    // Each comment belongs to a task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // And each comment is written by a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
