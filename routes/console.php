<?php

use App\Console\Commands\SendDueReminders;
use App\Console\Commands\SendMotivationalQuotes;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SendDueReminders::class)
    ->everyMinute()
    ->withoutOverlapping();

Schedule::command(
    SendMotivationalQuotes::class,
    ['morning']
)->dailyAt('08:00');

Schedule::command(
    SendMotivationalQuotes::class,
    ['afternoon']
)->dailyAt('13:00');

Schedule::command(
    SendMotivationalQuotes::class,
    ['evening']
)->dailyAt('20:00');