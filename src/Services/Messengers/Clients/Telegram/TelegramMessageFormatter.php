<?php

namespace Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram;

use Skater4\LaravelSentryNotifications\Services\Messengers\Interfaces\MessageFormatterInterface;
use Skater4\LaravelSentryNotifications\Helpers\MbString;
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
            $text .= MbString::mbUcfirst(trans('sentry-notifier::translations.project')) . ': ' . config('app.name') . PHP_EOL;
        }

        $text .= MbString::mbUcfirst(trans('sentry-notifier::translations.environment')) . ': ' . config('app.env') . PHP_EOL;
        $text .= '```' . MbString::mbUcfirst(trans('sentry-notifier::translations.error')) . ': ' . $e->getMessage() . '```' . PHP_EOL;

        return $text;
    }
}
