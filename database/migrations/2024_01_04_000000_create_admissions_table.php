<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admissions')) {
            Schema::create('admissions', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->date('date_of_birth');
                $table->enum('gender', ['Male', 'Female', 'Other']);
                $table->string('email');
                $table->string('phone', 20);
                $table->text('address');
                $table->string('grade_level');
                $table->string('previous_school')->nullable();
                $table->string('guardian_name');
                $table->string('guardian_relationship');
                $table->string('guardian_contact');
                $table->enum('status', ['Pending', 'Under Review', 'Approved', 'Rejected'])->default('Pending');
                $table->json('documents')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
