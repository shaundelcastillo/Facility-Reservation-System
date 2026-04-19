<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    // This allows Laravel to insert data into these specific columns
    protected $fillable = ['name', 'description', 'capacity', 'amenities'];
}