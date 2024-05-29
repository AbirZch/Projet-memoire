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
        Schema::table('course_sessions', function (Blueprint $table) {
            $table->renameColumn('course_types_id', 'course_type_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_sessions', function (Blueprint $table) {
            $table->renameColumn( 'course_type_id','course_types_id');

        });
    }
};
