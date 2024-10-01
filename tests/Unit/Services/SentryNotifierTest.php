<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Skater4\LaravelSentryNotifications\Exceptions\SentryNotifierException;
use Skater4\LaravelSentryNotifications\Services\SentryNotifier;
use Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces\SentryServiceInterface;
use Exception;

class SentryNotifierTest extends TestCase
{
    /**
     * @return void
     * @throws SentryNotifierException
     */
    public function testReportSentryNotification()
    {
        $sentryServiceMock = $this->createMock(SentryServiceInterface::class);
        $sentryServiceMock->method('captureException')
            ->willReturn('event_id');
        $sentryServiceMock->method('getIssueUrl')
            ->with('event_id')
            ->willReturn('http://example.com/event');

        $sentryNotifier = new SentryNotifier($sentryServiceMock);

        $sentryNotifier->reportSentryNotification(new Exception('Test exception'));
        $this->assertTrue(true);
    }
}
