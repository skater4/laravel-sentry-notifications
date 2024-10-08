<?php

namespace Skater4\LaravelSentryNotifications\Services\Sentry;

use Sentry\State\Hub;
use Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces\SentryServiceInterface;
use Throwable;

class SentryService implements SentryServiceInterface
{
    private $sentry;
    private $issuesUrl;

    public function __construct(Hub $sentry, string $issuesUrl)
    {
        $this->sentry = $sentry;
        $this->issuesUrl = rtrim($issuesUrl, '/') . '/';
    }

    public function captureException(Throwable $e): ?string {
        return $this->sentry->captureException($e);
    }

    public function getIssueUrl(string $eventId): string {
        $data = [
            'query' => 'id:' . $eventId
        ];

        return $this->issuesUrl . '?' . http_build_query($data);
    }
}
