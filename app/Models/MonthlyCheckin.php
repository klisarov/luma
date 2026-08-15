<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyCheckin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'difficulty_rating',
        'feedback_text',
        'ai_suggestions',
        'ai_suggestions_generated_at',
    ];

    protected function casts(): array
    {
        return [
            'month' => 'date',
            'ai_suggestions_generated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasAiSuggestions(): bool
    {
        return ! is_null($this->ai_suggestions);
    }
}