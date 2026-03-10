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
            $table->id('reservation_id'); // Matches PK in ERD
            
            
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('room_id')->constrained('rooms', 'room_id');
            
            
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('purpose');
            $table->string('status');
            
           
            $table->foreignId('approve_by')->nullable()->constrained('admin', 'admin_id');
            
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

