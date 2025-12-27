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
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('contact_messages', 'admin_reply')) {
                $table->text('admin_reply')->nullable()->after('message');
            }
            if (!Schema::hasColumn('contact_messages', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('admin_reply');
            }
            if (!Schema::hasColumn('contact_messages', 'replied_by')) {
                $table->unsignedBigInteger('replied_by')->nullable()->after('replied_at');
            }
            if (!Schema::hasColumn('contact_messages', 'user_has_seen_reply')) {
                $table->boolean('user_has_seen_reply')->default(false)->after('replied_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'admin_reply', 'replied_at', 'replied_by', 'user_has_seen_reply']);
        });
    }
};
