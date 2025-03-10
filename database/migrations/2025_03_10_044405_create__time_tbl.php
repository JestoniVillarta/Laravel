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
        Schema::create('time_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('morning_time_in'); // Changed from time to string
            $table->string('morning_time_in_end'); // Changed from time to string
            $table->string('morning_time_out'); // Changed from time to string
            $table->string('morning_time_out_end'); // Changed from time to string
            $table->string('afternoon_time_in'); // Changed from time to string
            $table->string('afternoon_time_in_end'); // Changed from time to string
            $table->string('afternoon_time_out'); // Changed from time to string
            $table->string('afternoon_time_out_end'); // Changed from time to string
            $table->timestamps(); // This adds 'created_at' and 'updated_at' columns
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tbl'); // This should be used to drop the table if it exists
    }
};
