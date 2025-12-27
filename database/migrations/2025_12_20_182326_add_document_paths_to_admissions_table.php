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
        Schema::table('admissions', function (Blueprint $table) {
            if (!Schema::hasColumn('admissions', 'birth_certificate_path')) {
                $table->string('birth_certificate_path')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('admissions', 'report_card_path')) {
                $table->string('report_card_path')->nullable()->after('birth_certificate_path');
            }
            if (!Schema::hasColumn('admissions', 'photo_path')) {
                $table->string('photo_path')->nullable()->after('report_card_path');
            }
            if (!Schema::hasColumn('admissions', 'submission_date')) {
                $table->timestamp('submission_date')->nullable()->after('photo_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            if (Schema::hasColumn('admissions', 'birth_certificate_path')) {
                $table->dropColumn('birth_certificate_path');
            }
            if (Schema::hasColumn('admissions', 'report_card_path')) {
                $table->dropColumn('report_card_path');
            }
            if (Schema::hasColumn('admissions', 'photo_path')) {
                $table->dropColumn('photo_path');
            }
            if (Schema::hasColumn('admissions', 'submission_date')) {
                $table->dropColumn('submission_date');
            }
        });
    }
};
