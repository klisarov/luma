<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitnessTipCache extends Model
{
    protected $table = 'fitness_tips_cache';

    protected $fillable = ['sex', 'tip', 'source_api', 'valid_for_date'];

    protected function casts(): array
    {
        return [
            'valid_for_date' => 'date',
        ];
    }

    public static function forToday(string $sex): ?self
    {
        return static::where('sex', $sex)
            ->whereDate('valid_for_date', now()->toDateString())
            ->inRandomOrder()
            ->first();
    }
}