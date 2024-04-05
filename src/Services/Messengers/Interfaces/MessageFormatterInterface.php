<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces;

use Throwable;

interface MessageFormatterInterface
{
    /**
     * @param Throwable $e
     * @return string
     */
    public function getExceptionMessage(Throwable $e): string;
}
