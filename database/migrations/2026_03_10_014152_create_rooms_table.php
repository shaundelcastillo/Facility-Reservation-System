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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id'); // Matches PK in your ERD
            $table->string('room_number');
            $table->integer('capacity');
            
            // Foreign Keys: These MUST match the table names and PKs we created
            $table->foreignId('building_id')->constrained('buildings', 'building_id');
            $table->foreignId('roomtype_id')->constrained('room_type', 'roomtype_id');
            
            $table->string('is_available'); // Based on your ERD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
