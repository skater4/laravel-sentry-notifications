<?php

namespace Tests\Unit\Services\Messengers\Clients\Telegram;

use Orchestra\Testbench\TestCase;
use Exception;
use Skater4\LaravelSentryNotifications\Services\Messengers\Clients\Telegram\TelegramMessageFormatter;

class TelegramMessageFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testFormatMessage()
    {
        $formatter = new TelegramMessageFormatter();
        $exception = new Exception('Test exception message');
        $message = $formatter->getExceptionMessage($exception);

        $this->assertStringContainsString('Test exception message', $message);
    }
}
