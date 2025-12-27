<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admission_status_history')) {
            Schema::create('admission_status_history', function (Blueprint $table) {
                $table->id();
                $table->foreignId('admission_id')->constrained('admissions')->onDelete('cascade');
                $table->string('old_status')->nullable();
                $table->string('new_status');
                $table->text('notes')->nullable();
                $table->foreignId('changed_by')->nullable()->constrained('users')->onDelete('set null');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_status_history');
    }
};
