<?php

namespace Skater4\LaravelSentryNotifications\Services;

use Log;
use Skater4\LaravelSentryNotifications\Services\Messengers\Factories\MessengerClientFactory;
use Skater4\LaravelSentryNotifications\Exceptions\SentryNotifierException;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Sentry\Interfaces\SentryServiceInterface;
use Throwable;

class SentryNotifier
{
    private $messengerClient;
    private $sentryService;
    private $dontReport = [
        SentryNotifierException::class,
        UnknownServiceException::class
    ];

    public function __construct(SentryServiceInterface $sentryService)
    {
        $this->sentryService = $sentryService;
    }

    public function reportSentryNotification(Throwable $e): void
    {
        if (!$this->canReportSentry($e)) {
            return;
        }

        if (!$this->messengerClient) {
            $this->messengerClient = app(MessengerClientFactory::class)->create();
        }

        try {
            $eventId = $this->sentryService->captureException($e);

            if (empty($eventId)) {
                throw new SentryNotifierException('Empty Event ID response');
            }

            $issueUrl = $this->sentryService->getIssueUrl($eventId);
            $this->messengerClient->sendMessage($e, $issueUrl);
        } catch (Throwable $_e) {
            Log::error(get_class($e) . 'Exception: ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
            throw new SentryNotifierException('Sentry Notifier error: ' . $_e->getMessage()
            );
        }
    }

    private function canReportSentry(Throwable $e): bool
    {
        return !in_array(get_class($e), $this->dontReport) && !empty(config('services.laravel-sentry-notifications.service'));
    }
}
