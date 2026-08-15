<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->string('workout_type')->nullable()->after('scheduled_time');

            $table->unsignedSmallInteger('duration_minutes')
                ->nullable()
                ->after('workout_type');

            $table->text('notes')
                ->nullable()
                ->after('duration_minutes');

            $table->boolean('is_completed_this_week')
                ->default(false)
                ->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->dropColumn([
                'workout_type',
                'duration_minutes',
                'notes',
                'is_completed_this_week',
            ]);
        });
    }
};