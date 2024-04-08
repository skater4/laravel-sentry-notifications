<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Interfaces;

interface NotifableEntityInterface
{
    /**
     * @param string $eventUrl
     * @return void
     */
    public function setEventUrl(string $eventUrl): void;

    /**
     * @return string
     */
    public function getEventUrl(): string;

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return string
     */
    public function getKey(): string;
}
