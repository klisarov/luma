<?php

namespace Database\Factories;

use App\Models\Calendar;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarEventFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+30 days');

        return [
            'calendar_id' => Calendar::factory(),
            'title' => fake()->sentence(3),
            'notes' => fake()->optional()->sentence(),
            'location' => fake()->optional()->city(),
            'starts_at' => $start,
            'ends_at' => (clone $start)->modify('+1 hour'),
            'is_all_day' => fake()->boolean(15),
            'is_recurring_yearly' => false,
            'notify_before_minutes' => fake()->randomElement([null, 30, 60, 1440]),
        ];
    }
}