<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces;

use Throwable;

interface MessengerClientInterface
{
    /**
     * @param Throwable $e
     * @param string $eventUrl
     * @return void
     */
    public function sendMessage(Throwable $e, string $eventUrl): void;
}
