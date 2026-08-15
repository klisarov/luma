<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'title',
        'description',
        'due_at',
        'due_date',
        'reminder_offset_minutes',
        'is_work_related',
        'is_completed',
        'completed_at',
        'priority',
        'reminder_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'due_at' => 'datetime',
            'due_date' => 'date',
            'completed_at' => 'datetime',
            'reminder_sent_at' => 'datetime',
            'is_work_related' => 'boolean',
            'is_completed' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        // Keep due_date in sync with due_at automatically so "today's tasks" queries stay simple.
        static::saving(function (Task $task) {
            if ($task->due_at && ! $task->due_date) {
                $task->due_date = $task->due_at->toDateString();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function toggleComplete(): void
    {
        $this->is_completed = ! $this->is_completed;
        $this->completed_at = $this->is_completed ? now() : null;
        $this->save();
    }

    /**
     * When a notification should fire, or null if not applicable.
     */
    public function reminderShouldFireAt(): ?\Carbon\Carbon
    {
        if (! $this->due_at || ! $this->reminder_offset_minutes) {
            return null;
        }

        return $this->due_at->copy()->subMinutes($this->reminder_offset_minutes);
    }
}