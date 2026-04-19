<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $primaryKey = 'building_id'; // Matches your migration
    protected $fillable = ['building_id', 'building_name', 'location'];
}