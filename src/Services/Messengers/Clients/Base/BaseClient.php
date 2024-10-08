<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Base;

use Illuminate\Notifications\Notification;
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

    protected function getMessageFormatter(): MessageFormatterInterface
    {
        if (!$this->messageFormatter) {
            $this->messageFormatter = app(MessageFormatterFactory::class)->create();
        }

        return $this->messageFormatter;
    }

    protected function getNotifableEntity(): NotifableEntityInterface
    {
        if (!$this->notifableEntity) {
            $this->notifableEntity = app(NotificationEntityFactory::class)->create();
        }

        return $this->notifableEntity;
    }

    protected function getNotificationClass(): Notification
    {
        if (!$this->notificationClass) {
            $this->notificationClass = app(NotificationFactory::class)->create();
        }

        return $this->notificationClass;
    }
}
