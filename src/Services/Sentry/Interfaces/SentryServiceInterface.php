<?php

namespace Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces;

use Throwable;

interface SentryServiceInterface
{
    public function captureException(Throwable $e): ?string;

    public function getIssueUrl(string $eventId): string;
}
