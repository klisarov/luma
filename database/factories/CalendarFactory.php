<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['work', 'study', 'exhibition', 'lecture', 'birthday']);

        return [
            'user_id' => User::factory(),
            'name' => ucfirst($type) . ' Calendar',
            'type' => $type,
            'color' => fake()->hexColor(),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}