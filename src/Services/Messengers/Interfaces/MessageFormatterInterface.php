<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces;

use Throwable;

interface MessageFormatterInterface
{
    public function getExceptionMessage(Throwable $e): string;
}
