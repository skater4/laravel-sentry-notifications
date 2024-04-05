<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Factories;

use Illuminate\Notifications\Notification;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;

class NotificationFactory
{
    private $service;

    public function __construct(string $service)
    {
        $this->service = $service;
    }

    /**
     * @return Notification
     * @throws UnknownServiceException
     */
    public function create(): Notification
    {
        switch ($this->service) {
            case Services::SERVICE_TELEGRAM:
                return resolve(TelegramSentryNotification::class);
            default:
                throw new UnknownServiceException('Unknown service ' . $this->service);
        }
    }
}
