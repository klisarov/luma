<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\CalendarEvent;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Task;
use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@luma.klisarov.com',
            'sex' => fake()->randomElement(['male', 'female']),
        ]);

        // Categories with subcategories, matching the user stories (Work, Study, Errands, Events)
        $categoryDefs = [
            'Work' => ['Meetings', 'Deep Work', 'Admin'],
            'Study' => ['Lectures', 'Assignments', 'Exams'],
            'Errands' => ['Shopping', 'Appointments'],
            'Events' => ['Exhibitions', 'Social'],
        ];

        $subcategories = collect();

        foreach ($categoryDefs as $name => $subs) {
            $category = Category::factory()->create(['user_id' => $user->id, 'name' => $name]);

            foreach ($subs as $subName) {
                $subcategories->push(
                    Subcategory::factory()->create(['category_id' => $category->id, 'name' => $subName])
                );
            }
        }

        $categories = $user->categories;

        // A realistic today: mix of completed/incomplete tasks across categories
        Task::factory()
            ->count(6)
            ->dueToday()
            ->create([
                'user_id' => $user->id,
                'category_id' => fn () => $categories->random()->id,
            ]);

        // Some tasks spread across other days, for calendar/list views
        Task::factory()
            ->count(15)
            ->create([
                'user_id' => $user->id,
                'category_id' => fn () => $categories->random()->id,
            ]);

        // Calendars: work, study, exhibition, lecture, birthday
        foreach (['work', 'study', 'exhibition', 'lecture', 'birthday'] as $i => $type) {
            $calendar = Calendar::factory()->create([
                'user_id' => $user->id,
                'type' => $type,
                'sort_order' => $i,
            ]);

            CalendarEvent::factory()->count(4)->create(['calendar_id' => $calendar->id]);
        }

        // Weekly workout plan, Mon/Wed/Fri
        foreach ([1, 3, 5] as $day) {
            WorkoutPlan::factory()->create([
                'user_id' => $user->id,
                'day_of_week' => $day,
            ]);
        }
    }
}