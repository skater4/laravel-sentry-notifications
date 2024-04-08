<?php

namespace Tests\Unit\Notifications\Services\Telegram\Entities;

use Orchestra\Testbench\TestCase;
use Skater4\LaravelSentryNotifications\Notifications\Services\Telegram\Entities\NotifableTelegramChannel;

class NotifableTelegramChannelTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanSetAndGetChatId()
    {
        $chatId = '123456789';
        $entity = new NotifableTelegramChannel($chatId);

        $this->assertEquals($chatId, $entity->getChatId());
    }

    /**
     * @return void
     */
    public function testCanSetAndGetMessage()
    {
        $message = 'Test Message';
        $entity = new NotifableTelegramChannel('123456789');
        $entity->setMessage($message);

        $this->assertEquals($message, $entity->getMessage());
    }

    /**
     * @return void
     */
    public function testCanSetAndGetEventUrl()
    {
        $eventUrl = 'http://example.com/event';
        $entity = new NotifableTelegramChannel('123456789');
        $entity->setEventUrl($eventUrl);

        $this->assertEquals($eventUrl, $entity->getEventUrl());
    }
}
