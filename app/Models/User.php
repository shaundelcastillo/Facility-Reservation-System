<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Tell Laravel the primary key is 'user_id', not 'id'
     * This matches your database structure shown in your migrations.
     */
    protected $primaryKey = 'user_id'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'student_id',
        'email',
        'password',
        'role',
        'course',
        'status',
    ];

    /**
     * This tells Laravel to use 'student_id' for authentication 
     * instead of the default 'email'.
     */
    public function username()
    {
        return 'student_id';
    }

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}