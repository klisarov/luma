<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('calendar_id')
                ->constrained('calendars')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('notes')->nullable();
            $table->string('location')->nullable();

            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();

            $table->boolean('is_all_day')->default(false);
            $table->boolean('is_recurring_yearly')->default(false);

            $table->unsignedInteger('notify_before_minutes')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();

            $table->timestamps();

            $table->index(['calendar_id', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
};