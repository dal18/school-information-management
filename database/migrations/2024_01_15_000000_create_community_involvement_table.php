<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('community_involvement')) {
            Schema::create('community_involvement', function (Blueprint $table) {
                $table->id();
                $table->string('activity_name');
                $table->text('description')->nullable();
                $table->integer('participants')->default(0);
                $table->date('activity_date');
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('community_involvement');
    }
};
