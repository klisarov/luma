<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MotivationalQuoteLog extends Model
{
    protected $table = 'motivational_quotes_log';

    protected $fillable = ['user_id', 'time_slot', 'quote', 'author', 'sent_date'];

    protected function casts(): array
    {
        return [
            'sent_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function alreadySentToday(int $userId, string $timeSlot): bool
    {
        return static::where('user_id', $userId)
            ->where('time_slot', $timeSlot)
            ->whereDate('sent_date', now()->toDateString())
            ->exists();
    }
}