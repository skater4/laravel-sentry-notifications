<?php

namespace Skater4\LaravelSentryNotifications\Services;

use Exception;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessengerClientInterface;
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

    /**
     * @param MessengerClientInterface $messengerClient
     * @param SentryServiceInterface $sentryService
     */
    public function __construct(
        MessengerClientInterface $messengerClient,
        SentryServiceInterface   $sentryService
    )
    {
        $this->messengerClient  = $messengerClient;
        $this->sentryService    = $sentryService;
    }

    /**
     * @param Throwable $e
     * @return void
     * @throws SentryNotifierException
     */
    public function reportSentryNotification(Throwable $e): void
    {
        if (!$this->canReportSentry($e)) {
            return;
        }

        try {
            $eventId = $this->sentryService->captureException($e);

            if (empty($eventId)) {
                throw new SentryNotifierException('Empty Event ID response');
            }

            $issueUrl = $this->sentryService->getIssueUrl($eventId);
            $this->messengerClient->sendMessage($e, $issueUrl);
        } catch (Exception $e) {
            throw new SentryNotifierException('Sentry Notifier error: ' . $e->getMessage()
            );
        }
    }

    /**
     * Check if exception should be report to Sentry
     *
     * @param Throwable $e
     * @return bool
     */
    private function canReportSentry(Throwable $e): bool
    {
        return !in_array(get_class($e), $this->dontReport);
    }
}
