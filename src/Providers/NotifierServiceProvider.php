<?php

namespace Skater4\LaravelSentryNotifications\Providers;

use Illuminate\Support\ServiceProvider;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationEntityFactory;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationFactory;
use Skater4\LaravelSentryNotifications\Services\Factories\MessengerServiceFactory;
use Skater4\LaravelSentryNotifications\Services\Messengers\Factories\MessageFormatterFactory;
use Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces\SentryServiceInterface;
use Skater4\LaravelSentryNotifications\Services\SentryNotifier;

class NotifierServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/services.php', 'services'
        );

        $this->app->singleton(SentryNotifier::class, function ($app) {
            return new SentryNotifier(
                MessengerServiceFactory::create($app['config']['services']['laravel-sentry-notifications']['service']),
                resolve(SentryServiceInterface::class),
            );
        });

        $this->app->singleton(MessageFormatterFactory::class, function ($app) {
            return new MessageFormatterFactory(
                $app['config']['services']['laravel-sentry-notifications']['service']
            );
        });

        $this->app->singleton(NotificationEntityFactory::class, function ($app) {
            return new NotificationEntityFactory(
                $app['config']['services']['laravel-sentry-notifications']['service']
            );
        });

        $this->app->singleton(NotificationFactory::class, function ($app) {
            return new NotificationFactory(
                $app['config']['services']['laravel-sentry-notifications']['service']
            );
        });
    }
}
