<?php

namespace Tests\Unit\Notifications\Factories;

use Orchestra\Testbench\Foundation\Application;
use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationEntityFactory;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Providers\TelegramServiceProvider;

class NotificationEntityFactoryTest extends TestCase
{
    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testCreatesNotifableTelegramChannelForTelegramService()
    {
        $factory = new NotificationEntityFactory(Services::SERVICE_TELEGRAM);
        $entity = $factory->create();

        $this->assertInstanceOf(NotifableTelegramChannel::class, $entity);
    }

    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testThrowsExceptionForUnknownService()
    {
        $this->expectException(UnknownServiceException::class);

        $factory = new NotificationEntityFactory('wtf?');
        $factory->create();
    }

    /**
     * @param Application $app
     * @return class-string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            TelegramServiceProvider::class,
        ];
    }
}
