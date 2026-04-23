<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // Point to the correct table name found in your Tinker output
    protected $table = 'facilities'; 

    // Match the primary key found in your Tinker output
    protected $primaryKey = 'id';

    // Allow these specific columns to be saved/updated
    protected $fillable = [
        'name', 
        'description', 
        'capacity', 
        'amenities', 
        'status'
    ];
}