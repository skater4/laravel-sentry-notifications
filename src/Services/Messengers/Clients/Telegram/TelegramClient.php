<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram;

use Illuminate\Support\Facades\Notification;
use Skater4\LaravelSentryNotifications\Enum\Services;
use Skater4\LaravelSentryNotifications\Exceptions\UnknownServiceException;
use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessengerClientInterface;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Base\BaseClient;
use Throwable;

class TelegramClient extends BaseClient implements MessengerClientInterface
{
    protected $service = Services::SERVICE_TELEGRAM;

    /**
     * @param Throwable $e
     * @param string $eventUrl
     * @return void
     * @throws UnknownServiceException
     */
    public function sendMessage(Throwable $e, string $eventUrl): void
    {
        $notifableEntity = $this->getNotifableEntity();
        $notifableEntity->setMessage(
            $this->getMessageFormatter()->getExceptionMessage($e)
        );
        $notifableEntity->setEventUrl($eventUrl);

        $notificationClass = $this->getNotificationClass();
        Notification::sendNow($notifableEntity, $notificationClass);
    }
}
