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
        Schema::table('feedback', function (Blueprint $table) {
            if (!Schema::hasColumn('feedback', 'status')) {
                $table->enum('status', ['New', 'In Progress', 'Resolved', 'Closed'])->default('New')->after('message');
            }
            if (!Schema::hasColumn('feedback', 'reply')) {
                $table->text('reply')->nullable()->after('message');
            }
            if (!Schema::hasColumn('feedback', 'reply_by')) {
                $table->unsignedBigInteger('reply_by')->nullable()->after('message');
            }
            if (!Schema::hasColumn('feedback', 'reply_date')) {
                $table->timestamp('reply_date')->nullable()->after('message');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn(['status', 'reply', 'reply_by', 'reply_date']);
        });
    }
};
