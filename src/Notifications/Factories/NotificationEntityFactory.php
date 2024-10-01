<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Factories;

use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Notifications\Interfaces\NotifableEntityInterface;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;

class NotificationEntityFactory
{
    private $service;

    public function __construct(string $service)
    {
        $this->service = $service;
    }

    public function create(): NotifableEntityInterface
    {
        switch ($this->service) {
            case Services::SERVICE_TELEGRAM:
                return app(NotifableTelegramChannel::class);
            default:
                throw new UnknownServiceException('Unknown service ' . $this->service);
        }
    }
}
