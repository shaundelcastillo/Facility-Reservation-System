<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_type', function (Blueprint $table) {
            $table->id('roomtype_id');
            $table->string('type_name'); // e.g., Computer Lab, Auditorium
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_type');
    }
};