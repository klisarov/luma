<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutPlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'day_of_week' => fake()->numberBetween(0, 6),
            'scheduled_time' => fake()->time('H:i'),
            'workout_type' => fake()->randomElement(['Push day', 'Pull day', 'Leg day', 'Cardio', 'Full body', 'Rest / Mobility']),
            'duration_minutes' => fake()->randomElement([30, 45, 60, 90]),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}