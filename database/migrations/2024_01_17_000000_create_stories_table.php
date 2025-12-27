<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('stories')) {
            Schema::create('stories', function (Blueprint $table) {
                $table->id();
                $table->string('student_name');
                $table->string('title');
                $table->text('content');
                $table->string('grade_level')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
