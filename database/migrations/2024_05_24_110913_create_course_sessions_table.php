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
        Schema::create('course_sessions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('course_types_id')->constrained();
            $table->timeTz('start_at');
            $table->timeTz('end_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_sessions');
    }
};
