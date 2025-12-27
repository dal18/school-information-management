<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('extracurricular')) {
            Schema::create('extracurricular', function (Blueprint $table) {
                $table->id();
                $table->string('program_name');
                $table->text('description')->nullable();
                $table->integer('member_count')->default(0);
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('extracurricular');
    }
};
