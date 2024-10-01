<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces;

use Throwable;

interface MessengerClientInterface
{
    public function sendMessage(Throwable $e, string $eventUrl): void;
}
