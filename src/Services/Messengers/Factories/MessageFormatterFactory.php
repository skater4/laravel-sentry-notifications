<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Factories;

use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramMessageFormatter;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;

class MessageFormatterFactory
{
    private $service;

    public function __construct(string $service)
    {
        $this->service = $service;
    }

    public function create(): MessageFormatterInterface
    {
        switch ($this->service) {
            case Services::SERVICE_TELEGRAM:
                return app(TelegramMessageFormatter::class);
            default:
                throw new UnknownServiceException('Unknown service ' . $this->service);
        }
    }
}
