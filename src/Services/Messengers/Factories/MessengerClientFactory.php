<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Factories;

use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramClient;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessengerClientInterface;

class MessengerClientFactory
{
    private $service;

    public function __construct(string $service)
    {
        $this->service = $service;
    }

    public function create(): MessengerClientInterface
    {
        switch ($this->service) {
            case Services::SERVICE_TELEGRAM:
                return app(TelegramClient::class);
            default:
                throw new UnknownServiceException('Unknown service ' . $this->service);
        }
    }
}
