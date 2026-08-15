<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'title',
        'notes',
        'location',
        'starts_at',
        'ends_at',
        'is_all_day',
        'is_recurring_yearly',
        'notify_before_minutes',
        'reminder_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_all_day' => 'boolean',
            'is_recurring_yearly' => 'boolean',
            'reminder_sent_at' => 'datetime',
        ];
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }

    public function reminderShouldFireAt(): ?\Carbon\Carbon
    {
        if (! $this->notify_before_minutes) {
            return null;
        }

        return $this->starts_at->copy()->subMinutes($this->notify_before_minutes);
    }
}