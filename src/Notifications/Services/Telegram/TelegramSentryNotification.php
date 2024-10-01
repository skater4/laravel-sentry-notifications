<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Services\Telegram;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;

class TelegramSentryNotification extends Notification
{
    public function via(): array
    {
        return [TelegramChannel::class];
    }

    public function toTelegram(NotifableTelegramChannel $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to($notifiable->getChatId())
            ->content($notifiable->getMessage())
            ->button('Sentry event URL', $notifiable->getEventUrl());
    }
}
