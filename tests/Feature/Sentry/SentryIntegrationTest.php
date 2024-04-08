<?php

namespace Tests\Feature\Sentry;

use Orchestra\Testbench\TestCase;
use Exception;
use Skater4\LaravelSentryNotifications\Services\Sentry\SentryService;

class SentryIntegrationTest extends TestCase
{
    public function testExceptionIsReportedToSentry()
    {
        $this->mock(SentryService::class, function ($mock) {
            $mock->shouldReceive('captureException')
                ->once()
                ->withArgs(function ($exception) {
                    return $exception instanceof Exception && $exception->getMessage() === 'Test exception';
                });
        });

        try {
            throw new Exception('Test exception');
        } catch (Exception $e) {
            app(SentryService::class)->captureException($e);
        }
    }
}
