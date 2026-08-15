<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        $dueAt = fake()->dateTimeBetween('-2 days', '+5 days');

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'subcategory_id' => null,
            'title' => fake()->sentence(4),
            'description' => fake()->optional()->paragraph(),
            'due_at' => $dueAt,
            'due_date' => $dueAt->format('Y-m-d'),
            'reminder_offset_minutes' => fake()->randomElement([null, 15, 30, 60]),
            'is_work_related' => fake()->boolean(30),
            'is_completed' => fake()->boolean(40),
            'priority' => fake()->numberBetween(1, 3),
        ];
    }

    /**
     * Force the task to be due today, for dashboard "today's plan" testing.
     */
    public function dueToday(): static
    {
        return $this->state(function () {
            $time = now()->setTime(fake()->numberBetween(8, 20), fake()->randomElement([0, 15, 30, 45]));

            return [
                'due_at' => $time,
                'due_date' => $time->toDateString(),
            ];
        });
    }
}