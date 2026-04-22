<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id'); 
            $table->string('room_number');
            $table->integer('capacity');
            
            // Updated: Added nullable() so these aren't required during 'Create'
            $table->foreignId('building_id')
                  ->nullable() 
                  ->constrained('buildings', 'building_id');

            $table->foreignId('roomtype_id')
                  ->nullable() 
                  ->constrained('room_type', 'roomtype_id');
            
            $table->string('is_available')->default('Yes'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};