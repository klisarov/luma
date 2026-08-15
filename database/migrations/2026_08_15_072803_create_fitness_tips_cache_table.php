<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fitness_tips_cache', function (Blueprint $table) {
            $table->id();

            $table->string('sex');
            $table->text('tip');
            $table->string('source_api')->nullable();
            $table->date('valid_for_date');

            $table->timestamps();

            $table->index(['sex', 'valid_for_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fitness_tips_cache');
    }
};