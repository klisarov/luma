<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\MotivationalQuoteService;
use Illuminate\Console\Command;

class SendMotivationalQuotes extends Command
{
    protected $signature = 'luma:send-motivational-quotes {slot : morning|afternoon|evening}';

    protected $description = 'Send the motivational quote for the given time slot to all users.';

    public function handle(MotivationalQuoteService $service): int
    {
        $slot = $this->argument('slot');

        if (! in_array($slot, ['morning', 'afternoon', 'evening'], true)) {
            $this->error('Invalid slot. Use morning, afternoon, or evening.');

            return self::FAILURE;
        }

        User::query()->chunkById(200, function ($users) use ($service, $slot) {
            foreach ($users as $user) {
                $service->sendFor($user, $slot);
            }
        });

        $this->info("Motivational quotes dispatched for slot: {$slot}");

        return self::SUCCESS;
    }
}