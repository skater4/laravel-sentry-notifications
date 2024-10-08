<?php

namespace Skater4\LaravelSentryNotifications\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Notifications\Notification;
use Illuminate\Support\ServiceProvider;
use Skater4\LaravelSentryNotifications\Exceptions\SentryNotifierException;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramClient;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramMessageFormatter;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;

class TelegramServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/services.php', 'services'
        );

        $this->app->when(TelegramClient::class)
            ->needs(MessageFormatterInterface::class)
            ->give(TelegramMessageFormatter::class);

        $this->app->bind(NotifableTelegramChannel::class, function (Application $app) {
            if (empty($app['config']['services']['laravel-sentry-notifications']['telegram']['chat_id'])) {
                throw new SentryNotifierException('Empty telegram Chat ID');
            }

            if (empty($app['config']['services']['telegram-bot-api']['token'])) {
                throw new SentryNotifierException('Empty telegram bit token');
            }

            return new NotifableTelegramChannel($app['config']['services']['laravel-sentry-notifications']['telegram']['chat_id']);
        });

        $this->app->when(TelegramClient::class)
            ->needs(Notification::class)
            ->give(TelegramSentryNotification::class);
    }
}
