<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('story_reactions')) {
            Schema::create('story_reactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('story_id');
                $table->string('user_ip')->nullable(); // For anonymous users
                $table->unsignedInteger('user_id')->nullable(); // For logged-in users
                $table->string('reaction_type')->default('like'); // like, love, heart, etc.
                $table->timestamps();

                // Foreign key constraints
                $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
                // Note: Not adding foreign key constraint for nullable user_id
                // to avoid MySQL foreign key constraint errors with nullable columns
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('story_reactions');
    }
};
