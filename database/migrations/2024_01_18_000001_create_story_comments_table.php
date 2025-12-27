<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('story_comments')) {
            Schema::create('story_comments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('story_id');
                $table->unsignedInteger('user_id')->nullable(); // For logged-in users
                $table->string('commenter_name')->nullable(); // For anonymous users
                $table->string('commenter_email')->nullable(); // For anonymous users
                $table->text('comment');
                $table->boolean('is_approved')->default(false); // Admin approval required
                $table->unsignedInteger('approved_by')->nullable();
                $table->timestamp('approved_at')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();

                // Foreign key constraints
                $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
                // Note: Not adding foreign key constraints for nullable user_id and approved_by
                // to avoid MySQL foreign key constraint errors with nullable columns
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('story_comments');
    }
};
