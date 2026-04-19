<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model // This MUST be 'Room'
{
    protected $primaryKey = 'room_id';
    protected $fillable = ['room_number', 'capacity', 'building_id', 'roomtype_id', 'is_available'];
}