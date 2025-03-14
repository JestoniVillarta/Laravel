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
        Schema::create('attendance_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('name');
            $table->string('gender');
            $table->date('date');
            $table->time('morning_time_in')->nullable();
            $table->time('morning_time_out')->nullable();
            $table->time('afternoon_time_in')->nullable();
            $table->time('afternoon_time_out')->nullable();
            $table->string('morning_status')->nullable();
            $table->string('afternoon_status')->nullable();
            $table->string('duty_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_tbl');
    }
};
