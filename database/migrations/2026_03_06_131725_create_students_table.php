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
    Schema::create('user', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->string('student_id')->unique(); 
        $table->string('full_name');
        $table->string('email')->unique();
        $table->string('status');
        $table->string('course');
        $table->timestamps(); // For auditing and tracking
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
