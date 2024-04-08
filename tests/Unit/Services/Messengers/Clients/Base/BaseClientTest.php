<?php

namespace Tests\Unit\Services\Messengers\Clients\Base;

use Illuminate\Notifications\Notification;
use PHPUnit\Framework\TestCase;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationEntityFactory;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationFactory;
use Skater4\LaravelSentryNotifications\Notifications\Interfaces\NotifableEntityInterface;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Base\BaseClient;
use Skater4\LaravelSentryNotifications\Services\Messengers\Factories\MessageFormatterFactory;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;

class BaseClientTest extends TestCase
{
    /**
     * @return void
     */
    public function testMessageFormatterIsReturnedCorrectly()
    {
        $formatterFactoryMock = $this->createMock(MessageFormatterFactory::class);

        $formatterMock = $this->createMock(MessageFormatterInterface::class);

        $formatterFactoryMock->method('create')->willReturn($formatterMock);

        $client = new class($formatterFactoryMock) extends BaseClient {
            public function __construct($messageFormatterFactory)
            {
                $this->messageFormatter = $messageFormatterFactory->create();
            }

            public function publicGetMessageFormatter(): MessageFormatterInterface
            {
                return $this->getMessageFormatter();
            }
        };

        $this->assertInstanceOf(MessageFormatterInterface::class, $client->publicGetMessageFormatter());
    }

    /**
     * @return void
     */
    public function testNotifableEntityIsReturnedCorrectly()
    {
        $notifableEntityFactoryMock = $this->createMock(NotificationEntityFactory::class);

        $notifableEntityMock = $this->createMock(NotifableEntityInterface::class);

        $notifableEntityFactoryMock->method('create')->willReturn($notifableEntityMock);

        $client = new class($notifableEntityFactoryMock) extends BaseClient {
            public function __construct($notifableEntityFactory)
            {
                $this->notifableEntity = $notifableEntityFactory->create();
            }

            public function publicGetNotifableEntity(): NotifableEntityInterface
            {
                return $this->getNotifableEntity();
            }
        };

        $this->assertInstanceOf(NotifableEntityInterface::class, $client->publicGetNotifableEntity());
    }

    /**
     * @return void
     */
    public function testNotificationIsReturnedCorrectly()
    {
        $notificationFactoryMock = $this->createMock(NotificationFactory::class);

        $notificationMock = $this->createMock(Notification::class);

        $notificationFactoryMock->method('create')->willReturn($notificationMock);

        $client = new class($notificationFactoryMock) extends BaseClient {
            public function __construct($notificationFactory)
            {
                $this->notificationClass = $notificationFactory->create();
            }

            public function publicGetNotification(): Notification
            {
                return $this->getNotificationClass();
            }
        };

        $this->assertInstanceOf(Notification::class, $client->publicGetNotification());
    }
}
