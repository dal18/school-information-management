<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if users table exists, if not create it
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('user_name')->unique();
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('phone_number')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('access_rights')->default('Student');
                $table->string('profile_image')->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        } else {
            // Table exists, add missing columns
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'user_name')) {
                    $table->string('user_name')->unique()->after('id');
                }
                if (!Schema::hasColumn('users', 'first_name')) {
                    $table->string('first_name')->after('user_name');
                }
                if (!Schema::hasColumn('users', 'middle_name')) {
                    $table->string('middle_name')->nullable()->after('first_name');
                }
                if (!Schema::hasColumn('users', 'last_name')) {
                    $table->string('last_name')->after('middle_name');
                }
                if (!Schema::hasColumn('users', 'phone_number')) {
                    $table->string('phone_number')->nullable();
                }
                if (!Schema::hasColumn('users', 'access_rights')) {
                    $table->string('access_rights')->default('Student');
                }
                if (!Schema::hasColumn('users', 'profile_image')) {
                    $table->string('profile_image')->nullable();
                }
                if (!Schema::hasColumn('users', 'deleted_date')) {
                    $table->timestamp('deleted_date')->nullable();
                }
                if (!Schema::hasColumn('users', 'remember_token')) {
                    $table->rememberToken();
                }
                if (!Schema::hasColumn('users', 'email_verified_at')) {
                    $table->timestamp('email_verified_at')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['user_name', 'first_name', 'middle_name', 'last_name', 'phone_number', 'access_rights', 'profile_image', 'deleted_date'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
