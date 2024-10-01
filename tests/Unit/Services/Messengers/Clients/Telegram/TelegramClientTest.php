<?php

namespace Tests\Unit\Services\Messengers\Clients\Telegram;

use Exception;
use Illuminate\Support\Facades\Notification;
use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Notifications\Interfaces\NotifableEntityInterface;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;
use Skater4\LaravelSentryNotifications\Providers\NotifierServiceProvider;
use Skater4\LaravelSentryNotifications\Providers\TelegramServiceProvider;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramClient;
use Illuminate\Container\Container;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;

class TelegramClientTest extends TestCase
{
    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            TelegramServiceProvider::class,
            NotifierServiceProvider::class
        ];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
        $container = Container::getInstance();

        $formatterMock = $this->createMock(MessageFormatterInterface::class);
        $formatterMock->method('getExceptionMessage')->willReturn('Formatted exception message');

        $notifableEntityMock = $this->createMock(NotifableEntityInterface::class);

        $container->bind(MessageFormatterInterface::class, function () use ($formatterMock) {
            return $formatterMock;
        });

        $container->bind(NotifableEntityInterface::class, function () use ($notifableEntityMock) {
            return $notifableEntityMock;
        });
    }

    /**
     * @return void
     * @throws UnknownServiceException
     */
    public function testSendMessage()
    {
        $client = app(TelegramClient::class);

        Notification::fake();
        Notification::assertNothingSent();

        $client->sendMessage(new Exception('Test exception'), 'http://example.com/event');

        Notification::assertSentTo(
            new NotifableTelegramChannel(123),
            TelegramSentryNotification::class
        );
    }
}
