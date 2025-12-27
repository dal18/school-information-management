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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('commenter_name')->nullable(); // For guest commenters
            $table->string('commenter_email')->nullable(); // For guest commenters
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->unsignedInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign key for post
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            // Index for better query performance
            $table->index(['post_id', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
