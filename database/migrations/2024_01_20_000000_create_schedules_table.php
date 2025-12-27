<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('schedules')) {
            Schema::create('schedules', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('subject_id');
                $table->unsignedBigInteger('teacher_id');
                $table->string('grade_level');
                $table->string('section');
                $table->string('day_of_week');
                $table->time('start_time');
                $table->time('end_time');
                $table->string('room')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
