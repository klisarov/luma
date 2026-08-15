<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day_of_week',
        'scheduled_time',
        'workout_type',
        'duration_minutes',
        'notes',
        'is_completed_this_week',
    ];

    protected function casts(): array
    {
        return [
            'is_completed_this_week' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dayName(): string
    {
        return \Carbon\Carbon::create(null, null, null)->startOfWeek(\Carbon\Carbon::SUNDAY)
            ->addDays($this->day_of_week)->format('l');
    }
}