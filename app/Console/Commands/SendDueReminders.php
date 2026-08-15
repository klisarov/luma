<?php

namespace App\Console\Commands;

use App\Models\CalendarEvent;
use App\Models\Task;
use App\Notifications\CalendarEventReminderNotification;
use App\Notifications\TaskReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendDueReminders extends Command
{
    protected $signature = 'luma:send-due-reminders';

    protected $description = 'Send due task and calendar event reminders.';

    public function handle(): int
    {
        $taskCount = $this->sendTaskReminders();
        $eventCount = $this->sendCalendarEventReminders();

        $this->info(
            "Luma reminders sent — Tasks: {$taskCount}, Calendar events: {$eventCount}"
        );

        return self::SUCCESS;
    }

    protected function sendTaskReminders(): int
    {
        $sent = 0;

        Task::query()
            ->whereNotNull('due_at')
            ->whereNotNull('reminder_offset_minutes')
            ->whereNull('reminder_sent_at')
            ->where('is_completed', false)
            ->with(['user', 'category'])
            ->orderBy('id')
            ->chunkById(100, function ($tasks) use (&$sent) {
                foreach ($tasks as $task) {
                    if (!$task->user) {
                        continue;
                    }

                    if (!$task->user->pushSubscriptions()->exists()) {
                        continue;
                    }

                    $fireAt = $task->reminderShouldFireAt();

                    if (!$fireAt) {
                        continue;
                    }

                    /*
                     * Reminder time has not arrived yet.
                     */
                    if ($fireAt->isFuture()) {
                        continue;
                    }

                    /*
                     * Avoid suddenly sending very old reminders.
                     */
                    if ($task->due_at->lt(now()->subDay())) {
                        continue;
                    }

                    try {
                        $task->user->notify(
                            new TaskReminderNotification($task)
                        );

                        $task->update([
                            'reminder_sent_at' => now(),
                        ]);

                        $sent++;

                        Log::info('Task reminder sent', [
                            'task_id' => $task->id,
                            'user_id' => $task->user_id,
                            'due_at' => $task->due_at?->toDateTimeString(),
                            'reminder_fire_at' => $fireAt->toDateTimeString(),
                        ]);
                    } catch (Throwable $exception) {
                        Log::error('Task reminder failed', [
                            'task_id' => $task->id,
                            'message' => $exception->getMessage(),
                        ]);

                        report($exception);
                    }
                }
            });

        return $sent;
    }

    protected function sendCalendarEventReminders(): int
    {
        $sent = 0;

        CalendarEvent::query()
            ->whereNotNull('starts_at')
            ->whereNotNull('notify_before_minutes')
            ->whereNull('reminder_sent_at')
            ->with(['calendar.user'])
            ->orderBy('id')
            ->chunkById(100, function ($events) use (&$sent) {
                foreach ($events as $event) {
                    $user = $event->calendar?->user;

                    if (!$user) {
                        continue;
                    }

                    if (!$user->pushSubscriptions()->exists()) {
                        continue;
                    }

                    $fireAt = $event->reminderShouldFireAt();

                    if (!$fireAt) {
                        continue;
                    }

                    /*
                     * Reminder time has not arrived yet.
                     */
                    if ($fireAt->isFuture()) {
                        continue;
                    }

                    /*
                     * Don't send ancient calendar reminders.
                     */
                    if ($event->starts_at->lt(now()->subDay())) {
                        continue;
                    }

                    try {
                        $user->notify(
                            new CalendarEventReminderNotification($event)
                        );

                        $event->update([
                            'reminder_sent_at' => now(),
                        ]);

                        $sent++;

                        Log::info('Calendar event reminder sent', [
                            'calendar_event_id' => $event->id,
                            'user_id' => $user->id,
                            'starts_at' => $event->starts_at?->toDateTimeString(),
                            'reminder_fire_at' => $fireAt->toDateTimeString(),
                        ]);
                    } catch (Throwable $exception) {
                        Log::error('Calendar event reminder failed', [
                            'calendar_event_id' => $event->id,
                            'message' => $exception->getMessage(),
                        ]);

                        report($exception);
                    }
                }
            });

        return $sent;
    }
}