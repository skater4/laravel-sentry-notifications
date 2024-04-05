<?php

namespace Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces;

use Throwable;

interface SentryServiceInterface
{
    /**
     * @param Throwable $e
     * @return string|null
     */
    public function captureException(Throwable $e): ?string;

    /**
     * @param string $eventId
     * @return string
     */
    public function getIssueUrl(string $eventId): string;
}
