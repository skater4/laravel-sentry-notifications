<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram;

use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;
use Throwable;

class TelegramMessageFormatter implements MessageFormatterInterface
{
    const MESSAGE_LENGTH = 1000;

    /**
     * @param Throwable $e
     * @return string
     */
    public function getExceptionMessage(Throwable $e): string
    {
        $text = '';

        if (!empty(config('app.name'))) {
            $text .= 'Project URL: ' . '[' . url('/') . '](' . url('/') . ')' . PHP_EOL;
        }

        $text .= 'Env: ' . config('app.env') . PHP_EOL;
        $text .= 'Exception: ' . get_class($e) . PHP_EOL;
        $text .= '```Error: ' . $e->getMessage() . '```' . PHP_EOL;
        $text .= '```Trace: ' . $e->getTraceAsString() . '```' . PHP_EOL;

        if (mb_strlen($text) > self::MESSAGE_LENGTH) {
            $text = mb_substr($text, 0, self::MESSAGE_LENGTH);
            $text = rtrim($text) . '...```';
        }

        return $text;
    }
}
