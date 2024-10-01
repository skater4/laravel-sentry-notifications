<?php

namespace Skater4\LaravelSentryNotifications\Services\Factories;

use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessengerClientInterface;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramClient;

class MessengerServiceFactory
{
    public static function create(string $service): MessengerClientInterface
    {
        switch ($service) {
            case Services::SERVICE_TELEGRAM:
                return resolve(TelegramClient::class);
            default:
                throw new UnknownServiceException('Unknown sentry notification service ' . $service);
        }
    }
}
