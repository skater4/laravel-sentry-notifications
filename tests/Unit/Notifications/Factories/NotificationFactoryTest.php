<?php

namespace Tests\Unit\Notifications\Factories;

use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationFactory;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;

class NotificationFactoryTest extends TestCase
{
    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testCreatesTelegramSentryNotification()
    {
        $factory = new NotificationFactory(Services::SERVICE_TELEGRAM);
        $notification = $factory->create();

        $this->assertInstanceOf(TelegramSentryNotification::class, $notification);
    }

    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testThrowsExceptionForUnknownService()
    {
        $this->expectException(UnknownServiceException::class);

        $factory = new NotificationFactory('wtf?');
        $factory->create();
    }
}
