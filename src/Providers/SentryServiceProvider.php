<?php

namespace Skater4\LaravelSentryNotifications\Providers;

use Illuminate\Support\ServiceProvider;
use Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces\SentryServiceInterface;
use Skater4\LaravelSentryNotifications\Services\Sentry\SentryService;

class SentryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SentryServiceInterface::class, function ($app) {
            return new SentryService(
                $app['sentry'],
                $app['config']['services']['laravel-sentry-notifications']['issues_url'],
            );
        });
    }
}
