<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    // This tells Laravel the table name is 'room_type' (singular) 
    // instead of the default 'room_types' (plural)
    protected $table = 'room_type';

    protected $primaryKey = 'roomtype_id';

    protected $fillable = ['roomtype_id', 'type_name'];
}