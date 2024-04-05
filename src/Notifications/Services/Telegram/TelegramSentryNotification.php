<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Services\Telegram;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;

class TelegramSentryNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return [TelegramChannel::class];
    }

    /**
     * @param NotifableTelegramChannel $notifiable
     * @return TelegramMessage
     */
    public function toTelegram(NotifableTelegramChannel $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to($notifiable->getChatId())
            ->content($notifiable->getMessage())
            ->button(trans('sentry-notifier::translations.sentry_event_url'), $notifiable->getEventUrl());
    }
}
