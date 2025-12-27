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
        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'youtube_url')) {
                $table->string('youtube_url')->nullable()->after('image');
            }
            if (!Schema::hasColumn('activities', 'facebook_url')) {
                $table->string('facebook_url')->nullable()->after('youtube_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['youtube_url', 'facebook_url']);
        });
    }
};
