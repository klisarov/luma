<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TaskReminderNotification extends Notification
{
    use Queueable;

    public function __construct(public Task $task)
    {
    }

    public function via(object $notifiable): array
    {
        return [
            'database',
            WebPushChannel::class,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'task_reminder',
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'due_at' => $this->task->due_at?->toIso8601String(),
            'category' => $this->task->category?->name,
        ];
    }

    public function toWebPush(
        $notifiable,
        $notification
    ): WebPushMessage {
        return (new WebPushMessage)
            ->title(
                'Coming up: '.$this->task->title
            )
            ->icon('/icons/icon-192.png')
            ->badge('/icons/icon-192.png')
            ->body(
                $this->task->due_at
                    ? 'Due at '.$this->task->due_at->format('H:i')
                    : 'Due today'
            )
            ->action(
                'Open Luma',
                'open_luma'
            )
            ->data([
                'url' => route('dashboard'),
            ])
            ->tag(
                'task-reminder-'.$this->task->id
            )
            ->options([
                'TTL' => 3600,
            ]);
    }
}