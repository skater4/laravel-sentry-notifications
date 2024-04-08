<?php

namespace Tests\Unit\Services\Messengers\Factories;

use PHPUnit\Framework\TestCase;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramMessageFormatter;
use Skater4\LaravelSentryNotifications\Services\Messengers\Factories\MessageFormatterFactory;

class MessageFormatterFactoryTest extends TestCase
{
    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testCreatesTelegramMessageFormatter()
    {
        $factory = new MessageFormatterFactory(Services::SERVICE_TELEGRAM);
        $formatter = $factory->create();

        $this->assertInstanceOf(TelegramMessageFormatter::class, $formatter);
    }

    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testThrowsExceptionForUnknownService()
    {
        $this->expectException(UnknownServiceException::class);

        $factory = new MessageFormatterFactory('wtf?');
        $factory->create();
    }
}
