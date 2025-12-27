<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('administrators')) {
            Schema::create('administrators', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position');
                $table->string('category')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->text('bio')->nullable();
                $table->string('image')->nullable();
                $table->integer('display_order')->default(0);
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
