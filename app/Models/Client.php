<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'affiliation',
        'other_details',
        'created_by',
    ];

    // Define a relationship with the projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // If you want to track which user created the client:
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
