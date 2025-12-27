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
        // Check if midle_name column exists and middle_name doesn't
        if (Schema::hasColumn('users', 'midle_name') && !Schema::hasColumn('users', 'middle_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('midle_name', 'middle_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to midle_name if needed
        if (Schema::hasColumn('users', 'middle_name') && !Schema::hasColumn('users', 'midle_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('middle_name', 'midle_name');
            });
        }
    }
};
