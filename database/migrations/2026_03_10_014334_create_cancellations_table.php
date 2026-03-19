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
        Schema::create('cancellations', function (Blueprint $table) {
            $table->id('cancel_id'); 
            
            // Foreign Keys (FK)
            $table->foreignId('reservation_id')->constrained('reservations', 'reservation_id');
            $table->foreignId('cancelled_by')->constrained('admin', 'admin_id');
            
            // Cancellation Details
            $table->dateTime('cancel_date');
            $table->text('reason');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellations');
    }
};
