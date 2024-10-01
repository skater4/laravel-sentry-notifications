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

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setEventUrl(string $eventUrl): void
    {
        $this->eventUrl = $eventUrl;
    }

    public function getEventUrl(): string
    {
        return $this->eventUrl;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getKey(): string
    {
        return $this->chatId;
    }
}
