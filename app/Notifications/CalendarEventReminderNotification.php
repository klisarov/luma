<?php

namespace App\Notifications;

use App\Models\CalendarEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class CalendarEventReminderNotification extends Notification
{
    use Queueable;

    public function __construct(public CalendarEvent $event)
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
            'type' => 'calendar_event_reminder',
            'calendar_event_id' => $this->event->id,
            'calendar_name' => $this->event->calendar->name,
            'title' => $this->event->title,
            'starts_at' => $this->event->starts_at?->toIso8601String(),
            'location' => $this->event->location,
        ];
    }

    public function toWebPush(
        object $notifiable,
        Notification $notification
    ): WebPushMessage {
        $calendarName = $this->event->calendar?->name ?? 'Calendar';

        $body = $this->event->starts_at
            ? 'Starts at ' . $this->event->starts_at->format('H:i')
            : 'Upcoming event';

        if ($this->event->location) {
            $body .= ' · ' . $this->event->location;
        }

        return (new WebPushMessage)
            ->title(
                $calendarName . ': ' . $this->event->title
            )
            ->body($body)
            ->icon('/icons/icon-192.png')
            ->badge('/icons/icon-192.png')
            ->action(
                'Open Luma',
                'open_luma'
            )
            ->data([
                'url' => route('calendars.index'),
            ])
            ->tag(
                'calendar-event-reminder-' . $this->event->id
            )
            ->options([
                'TTL' => 3600,
            ]);
    }
}