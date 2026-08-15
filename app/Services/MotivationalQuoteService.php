<?php

namespace App\Services;

use App\Models\MotivationalQuoteLog;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MotivationalQuoteService
{
    protected const ZENQUOTES_RANDOM = 'https://zenquotes.io/api/random';

    /**
     * Send today's quote for a given time slot to a user, unless already sent.
     */
    public function sendFor(User $user, string $timeSlot): ?MotivationalQuoteLog
    {
        if (MotivationalQuoteLog::alreadySentToday($user->id, $timeSlot)) {
            return null;
        }

        $quote = $this->fetchQuote();

        if (! $quote) {
            return null;
        }

        $log = MotivationalQuoteLog::create([
            'user_id' => $user->id,
            'time_slot' => $timeSlot,
            'quote' => $quote['q'],
            'author' => $quote['a'] ?? null,
            'sent_date' => now()->toDateString(),
        ]);

        $user->notify(new \App\Notifications\MotivationalQuoteNotification($log));

        return $log;
    }

    protected function fetchQuote(): ?array
    {
        try {
            $response = Http::timeout(5)->get(self::ZENQUOTES_RANDOM);

            if (! $response->successful()) {
                return null;
            }

            return $response->json()[0] ?? null;
        } catch (\Throwable $e) {
            Log::warning('MotivationalQuoteService: failed to fetch from ZenQuotes', ['error' => $e->getMessage()]);

            return null;
        }
    }
}