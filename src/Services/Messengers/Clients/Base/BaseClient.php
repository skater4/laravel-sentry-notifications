<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Base;

use Illuminate\Notifications\Notification;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationEntityFactory;
use Skater4\LaravelSentryNotifications\Notifications\Factories\NotificationFactory;
use Skater4\LaravelSentryNotifications\Notifications\Interfaces\NotifableEntityInterface;
use Skater4\LaravelSentryNotifications\Services\Messengers\Factories\MessageFormatterFactory;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;

abstract class BaseClient
{
    protected $service;
    protected $messageFormatter;
    protected $notifableEntity;
    protected $notificationClass;

    /**
     * @return MessageFormatterInterface
     * @throws UnknownServiceException
     */
    protected function getMessageFormatter(): MessageFormatterInterface
    {
        if (!$this->messageFormatter) {
            $this->messageFormatter = resolve(MessageFormatterFactory::class)->create();
        }

        return $this->messageFormatter;
    }

    /**
     * @return NotifableEntityInterface
     * @throws UnknownServiceException
     */
    protected function getNotifableEntity(): NotifableEntityInterface
    {
        if (!$this->notifableEntity) {
            $this->notifableEntity = resolve(NotificationEntityFactory::class)->create();
        }

        return $this->notifableEntity;
    }

    /**
     * @return Notification
     * @throws UnknownServiceException
     */
    protected function getNotificationClass(): Notification
    {
        if (!$this->notificationClass) {
            $this->notificationClass = resolve(NotificationFactory::class)->create();
        }

        return $this->notificationClass;
    }
}
