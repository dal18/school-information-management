<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('temp_users')) {
            Schema::create('temp_users', function (Blueprint $table) {
                $table->id();
                $table->string('full_name');
                $table->string('user_name')->unique();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('verification_code', 6);
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('temp_users');
    }
};
