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
        Schema::create('blog_reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('guest_identifier')->nullable(); // For non-logged in users
            $table->string('reaction_type')->default('like'); // like, heart, etc.
            $table->timestamps();

            // Foreign key for post
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            // Unique constraint to prevent duplicate reactions
            $table->unique(['post_id', 'user_id', 'guest_identifier'], 'unique_blog_reaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_reactions');
    }
};
