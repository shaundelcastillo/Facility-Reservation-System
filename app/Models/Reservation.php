<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // This matches the primary key you likely have in your migration
    protected $primaryKey = 'reservation_id';

    // These are the fields we are allowed to save
    protected $fillable = [
        'user_id',
        'room_id',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'approved_by'
    ];

    /**
     * Optional: Define relationships
     * This helps if you want to display the Room name or User name later
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}