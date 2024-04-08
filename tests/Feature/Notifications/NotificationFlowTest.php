<?php

namespace Tests\Feature\Notifications;

use Illuminate\Support\Facades\Notification;
use Mockery;
use Orchestra\Testbench\TestCase;
use Exception;
use Orchestra\Testbench\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Skater4\LaravelSentryNotifications\Exceptions\SentryNotifierException;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;
use Skater4\LaravelSentryNotifications\Services\SentryNotifier;

class NotificationFlowTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        $this->app->instance(ExceptionHandler::class, new Handler(app()));
    }

    /**
     * @return void
     * @throws SentryNotifierException
     */
    public function testDirectCallOfReportSentryNotificationTriggersNotificationFlow()
    {
        $sentryNotifierMock = $this->mock(SentryNotifier::class);

        $sentryNotifierMock->shouldReceive('reportSentryNotification')
            ->once()
            ->with(Mockery::type(Exception::class))
            ->andReturnUsing(function () {
                Notification::send(new NotifableTelegramChannel(123), new TelegramSentryNotification());
            });

        /** @var SentryNotifier $sentryNotifierMock */
        $sentryNotifierMock->reportSentryNotification(new Exception('Test exception'));

        Notification::assertSentTo(
            new NotifableTelegramChannel(123),
            TelegramSentryNotification::class
        );
    }
}
