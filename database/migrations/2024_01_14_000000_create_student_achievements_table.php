<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('student_achievements')) {
            Schema::create('student_achievements', function (Blueprint $table) {
                $table->id();
                $table->string('student_name');
                $table->string('achievement');
                $table->text('description')->nullable();
                $table->date('date_achieved');
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('student_achievements');
    }
};
