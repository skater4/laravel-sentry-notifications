<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use Skater4\LaravelSentryNotifications\Exceptions\SentryNotifierException;
use Skater4\LaravelSentryNotifications\Services\SentryNotifier;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessengerClientInterface;
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
        $messengerClientMock = $this->createMock(MessengerClientInterface::class);
        $messengerClientMock->expects($this->once())
            ->method('sendMessage')
            ->with($this->isInstanceOf(Exception::class), $this->stringContains('http://example.com/event'));

        $sentryServiceMock = $this->createMock(SentryServiceInterface::class);
        $sentryServiceMock->method('captureException')
            ->willReturn('event_id');
        $sentryServiceMock->method('getIssueUrl')
            ->with('event_id')
            ->willReturn('http://example.com/event');

        $sentryNotifier = new SentryNotifier($messengerClientMock, $sentryServiceMock);

        $sentryNotifier->reportSentryNotification(new Exception('Test exception'));
    }
}
