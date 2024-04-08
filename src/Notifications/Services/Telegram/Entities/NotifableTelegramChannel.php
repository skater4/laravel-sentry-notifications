<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities;

use Illuminate\Notifications\Notifiable;
use Skater4\LaravelSentryNotifications\Notifications\Interfaces\NotifableEntityInterface;

class NotifableTelegramChannel implements NotifableEntityInterface
{
    use Notifiable;

    private $chatId;
    private $eventUrl;
    private $message;

    /**
     * @param string $chatId
     * @param string $eventUrl
     * @param string $message
     */
    public function __construct(
        string $chatId,
        string $message = '',
        string $eventUrl = ''
    )
    {
        $this->chatId   = $chatId;
        $this->eventUrl = $eventUrl;
        $this->message  = $message;
    }

    /**
     * @return string
     */
    public function getChatId(): string
    {
        return $this->chatId;
    }

    /**
     * @param string $eventUrl
     * @return void
     */
    public function setEventUrl(string $eventUrl): void
    {
        $this->eventUrl = $eventUrl;
    }

    /**
     * @return string
     */
    public function getEventUrl(): string
    {
        return $this->eventUrl;
    }

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->chatId;
    }
}
