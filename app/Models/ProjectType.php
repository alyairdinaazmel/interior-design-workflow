<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the projects associated with the project type.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
