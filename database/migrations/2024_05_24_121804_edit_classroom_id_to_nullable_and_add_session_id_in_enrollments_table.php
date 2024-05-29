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
        Schema::table('enrollments', function (Blueprint $table) {
          $table->foreignId('classroom_id')->nullable()->change();
          $table->foreignId('course_session_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->foreignId('classroom_id')->change();
            $table->dropColumn('course_session_id');
        });
    }
};
