<?php

namespace Tests\Unit\Services\Factories;

use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Factories\MessengerServiceFactory;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramClient;

class MessengerServiceFactoryTest extends TestCase
{
    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testCreatesTelegramClient()
    {
        $factory = new MessengerServiceFactory();
        $service = $factory->create(Services::SERVICE_TELEGRAM);

        $this->assertInstanceOf(TelegramClient::class, $service);
    }

    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testThrowsExceptionForUnknownService()
    {
        $this->expectException(UnknownServiceException::class);

        $factory = new MessengerServiceFactory();
        $factory->create('wtf?');
    }
}
