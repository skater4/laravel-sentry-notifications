<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram;

use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;
use Throwable;

class TelegramMessageFormatter implements MessageFormatterInterface
{
    /**
     * @param Throwable $e
     * @return string
     */
    public function getExceptionMessage(Throwable $e): string
    {
        $text = '';

        if (!empty(config('app.name'))) {
            $text .= 'Project: ' . config('app.name') . PHP_EOL;
        }

        $text .= 'Env: ' . config('app.env') . PHP_EOL;
        $text .= '```Error: ' . $e->getMessage() . '```' . PHP_EOL;

        return $text;
    }
}
