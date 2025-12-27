<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cultural_sport_events')) {
            Schema::create('cultural_sport_events', function (Blueprint $table) {
                $table->id();
                $table->string('event_name');
                $table->text('description')->nullable();
                $table->date('event_date');
                $table->timestamps();
                $table->timestamp('deleted_date')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cultural_sport_events');
    }
};
