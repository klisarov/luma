<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motivational_quotes_log', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('time_slot', 20);

            $table->text('quote');

            $table->string('author')->nullable();

            $table->date('sent_date');

            $table->timestamps();

            $table->index([
                'user_id',
                'time_slot',
                'sent_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motivational_quotes_log');
    }
};