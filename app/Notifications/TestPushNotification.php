<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TestPushNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return [
            WebPushChannel::class,
        ];
    }

    public function toWebPush(
        object $notifiable,
        Notification $notification
    ): WebPushMessage {
        return (new WebPushMessage)
            ->title('Luma - Notification')
            ->body('majmunee ;)')
            ->icon('/icons/icon-192.png')
            ->badge('/icons/icon-192.png')
            ->data([
                'url' => '/dashboard',
            ])
            ->tag('luma-test')
            ->requireInteraction()
            ->options([
                'TTL' => 1000,
            ]);
    }
}