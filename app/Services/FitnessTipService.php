<?php

namespace App\Services;

use App\Models\FitnessTipCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FitnessTipService
{
    protected const WGER_BASE = 'https://wger.de/api/v2';

    /**
     * Curated framing per sex — Wger gives us raw exercise data, we
     * turn that into a short, actionable tip. Kept in code (not the
     * API) since Wger doesn't offer sex-specific coaching copy.
     */
    protected const FRAMES = [
        'male' => [
            'Try adding {exercise} to your next session — focus on compound lifts for strength gains.',
            'Consider {exercise} today. Progressive overload matters more than volume — add weight before adding sets.',
            "Don't skip mobility work. Pair {exercise} with a proper warm-up to protect your joints long-term.",
        ],
        'female' => [
            'Try adding {exercise} to your next session — resistance training supports bone density at every age.',
            'Consider {exercise} today. Don\'t be afraid to lift heavy — strength training won\'t make you "bulky", it builds resilience.',
            'Pair {exercise} with adequate protein intake and rest — recovery is where the gains actually happen.',
        ],
    ];

    /**
     * Get today's tip for a sex, using cache if available, otherwise fetch + cache.
     */
    public function getTipFor(string $sex): ?string
    {
        $cached = FitnessTipCache::forToday($sex);

        if ($cached) {
            return $cached->tip;
        }

        return $this->fetchAndCache($sex)?->tip;
    }

    protected function fetchAndCache(string $sex): ?FitnessTipCache
    {
        try {
            $response = Http::timeout(5)->get(self::WGER_BASE . '/exercise/', [
                'language' => 2, // English
                'limit' => 30,
            ]);

            if (! $response->successful()) {
                return null;
            }

            $exercises = collect($response->json('results', []))
                ->pluck('name')
                ->filter()
                ->values();

            if ($exercises->isEmpty()) {
                return null;
            }

            $exerciseName = $exercises->random();
            $frame = collect(self::FRAMES[$sex] ?? self::FRAMES['male'])->random();
            $tip = str_replace('{exercise}', $exerciseName, $frame);

            return FitnessTipCache::create([
                'sex' => $sex,
                'tip' => $tip,
                'source_api' => 'wger',
                'valid_for_date' => now()->toDateString(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('FitnessTipService: failed to fetch from Wger API', ['error' => $e->getMessage()]);

            return null;
        }
    }
}