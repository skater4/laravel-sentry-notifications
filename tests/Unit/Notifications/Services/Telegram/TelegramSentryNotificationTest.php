<?php

namespace Tests\Unit\Notifications\Services\Telegram;

use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\TelegramSentryNotification;

class TelegramSentryNotificationTest extends TestCase
{
    /**
     * @return void
     */
    public function testTelegramNotificationDataStructure()
    {
        $notification = new TelegramSentryNotification();

        $notifiable = $this->createMock(NotifableTelegramChannel::class);
        $notifiable->method('getChatId')->willReturn('123456789');
        $notifiable->method('getMessage')->willReturn('Error: wtf?');

        $data = $notification->toTelegram($notifiable);

        $this->assertNotNull($data->getPayloadValue('text'));
        $this->assertNotNull($data->getPayloadValue('chat_id'));
        $this->assertEquals('123456789', $data->getPayloadValue('chat_id'));
        $this->assertStringContainsString('Error', $data->getPayloadValue('text'));
    }
}
