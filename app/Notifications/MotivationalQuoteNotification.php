<?php

namespace App\Notifications;

use App\Models\MotivationalQuoteLog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class MotivationalQuoteNotification extends Notification
{
    use Queueable;

    public function __construct(public MotivationalQuoteLog $log)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', WebPushChannel::class];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'motivational_quote',
            'time_slot' => $this->log->time_slot,
            'quote' => $this->log->quote,
            'author' => $this->log->author,
        ];
    }

    public function toWebPush($notifiable, $notification): WebPushMessage
    {
        $slotLabel = ucfirst($this->log->time_slot);

        return (new WebPushMessage)
            ->title("$slotLabel motivation")
            ->icon('/images/luma-icon.png')
            ->body('"' . $this->log->quote . '" — ' . ($this->log->author ?? 'Unknown'))
            ->data(['url' => route('dashboard')]);
    }
}