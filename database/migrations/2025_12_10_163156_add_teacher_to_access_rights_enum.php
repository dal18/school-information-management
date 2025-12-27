<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN access_rights ENUM('Student', 'Admin', 'User', 'Teacher') NOT NULL DEFAULT 'Student'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove Teacher role from all users that have it (set to User)
        DB::statement("UPDATE users SET access_rights = 'User' WHERE access_rights = 'Teacher'");
        // Revert ENUM to original values
        DB::statement("ALTER TABLE users MODIFY COLUMN access_rights ENUM('Student', 'Admin', 'User') NOT NULL DEFAULT 'Student'");
    }
};
