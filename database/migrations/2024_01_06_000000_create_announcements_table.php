<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('announcements')) {
            Schema::create('announcements', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->unsignedBigInteger('posted_by');
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();

                // Add foreign key only if users table has bigint id
                $userIdType = DB::select("SHOW COLUMNS FROM users WHERE Field = 'id'");
                if (!empty($userIdType) && strpos($userIdType[0]->Type, 'bigint') !== false) {
                    $table->foreign('posted_by')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
