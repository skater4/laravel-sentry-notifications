<?php

return [
    #https://github.com/laravel-notification-channels/telegram
    'telegram-bot-api' => [
        'token'     => env('SENTRY_TELEGRAM_BOT_TOKEN')
    ],
    //

    'laravel-sentry-notifications' => [
        'service'       => env('SENTRY_NOTIFICATION_SERVICE'),
        'issues_url'    => env('SENTRY_ISSUES_URL', 'https://sentry.io/organizations/sentry/issues'),
        'telegram'      => [
            'chat_id'       => env('SENTRY_TELEGRAM_CHAT_ID')
        ],
    ]
];
