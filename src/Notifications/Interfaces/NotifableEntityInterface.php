<?php

namespace Skater4\LaravelSentryNotifications\Notifications\Interfaces;

interface NotifableEntityInterface
{
    public function setEventUrl(string $eventUrl): void;

    public function getEventUrl(): string;

    public function setMessage(string $message): void;

    public function getMessage(): string;

    public function getKey(): string;
}
