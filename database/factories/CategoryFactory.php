<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement(['Work', 'Study', 'Errands', 'Events', 'Personal']),
            'color' => fake()->hexColor(),
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}