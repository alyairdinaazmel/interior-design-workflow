<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Consider renaming to 'role_id' if using foreign keys
        'contact',
        'profile_photo_path',
        'specific_role',
    ];

    /**
     * Get the role associated with the user.
     */
    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role'); // Adjust if using 'role_id'
    }

    // Rest of your model...
}
