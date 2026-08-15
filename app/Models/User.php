<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasPushSubscriptions;

    protected $fillable = [
        'name',
        'email',
        'password',
        'sex',
        'timezone',
        'locale',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class)->orderBy('sort_order');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function calendars(): HasMany
    {
        return $this->hasMany(Calendar::class)->orderBy('sort_order');
    }

    public function workoutPlans(): HasMany
    {
        return $this->hasMany(WorkoutPlan::class);
    }

    public function monthlyCheckins(): HasMany
    {
        return $this->hasMany(MonthlyCheckin::class);
    }

    /**
     * Tasks due today, used by the dashboard "today's plan" widget.
     */
    public function todaysTasks(): HasMany
    {
        return $this->tasks()
            ->whereDate('due_at', now($this->timezone)->toDateString())
            ->orderBy('due_at');
    }

    /**
     * Percentage of today's tasks completed.
     */
    public function todaysCompletionPercentage(): int
    {
        $today = $this->todaysTasks()->get();

        if ($today->isEmpty()) {
            return 0;
        }

        return (int) round(
            ($today->where('is_completed', true)->count() / $today->count()) * 100
        );
    }
}