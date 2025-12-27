<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('student_testimonials')) {
            Schema::create('student_testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('student_name');
                $table->string('grade_level');
                $table->text('message');
                $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('student_testimonials');
    }
};
