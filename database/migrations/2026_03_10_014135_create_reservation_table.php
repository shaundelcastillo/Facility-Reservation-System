<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id'); // Primary Key

            // Foreign Key to Users table
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            
            // Foreign Key to Rooms/Facilities table
            // Ensure you have a 'rooms' migration with $table->id('room_id')
            $table->foreignId('room_id')->constrained('rooms', 'room_id')->onDelete('cascade');
            
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('purpose');
            $table->string('status')->default('pending'); // Default status for new requests
            
            // Foreign Key for Admin approval
            // Ensure you have an 'admin' migration with $table->id('admin_id')
            $table->foreignId('approve_by')->nullable()->constrained('admin', 'admin_id')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};