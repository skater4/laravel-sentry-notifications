# Sentry Notifications Channels for Laravel

[![Chat on Telegram][ico-telegram]][link-telegram]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-packagist]

This package makes it easy to send Sentry notification to different channels in Laravel.

## Contents

- [Installation](#installation)
  - [Sentry](#setting-up-sentry)
  - [Telegram](#setting-up-telegram)
- [Usage](#usage)
- [Alternatives](#alternatives)
- [Changelog](#changelog)
- [Testing](#testing)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

```bash
composer require skater4/laravel-sentry-notifications
```

## Setting up Sentry

After basic Sentry set up you have to add Issues URL to .env

```dotenv
SENTRY_ISSUES_URL=https://sentry.io/organizations/sentry/issues
```

## Setting up Telegram

To use Telegram for your notifications you need first set up your telegram bot ant obtain Chat\Channel ID. Please, follow these [instructions](https://github.com/laravel-notification-channels/telegram?tab=readme-ov-file#setting-up-your-telegram-bot)

Then add following settings to .env

```dotenv
SENTRY_TELEGRAM_BOT_TOKEN=<your:bot-token>
SENTRY_TELEGRAM_CHAT_ID=<your_chat_id>
SENTRY_NOTIFICATION_SERVICE=telegram
```

## Usage

Just add following code where exception is handled to be reported

```php
resolve(SentryNotifier::class)->reportSentryNotification($exception);
```

For example report method in default exception handler

```php
public function report(Throwable $exception)
{
    if (app()->bound('sentry') && $this->shouldReport($exception)) {
        resolve(SentryNotifier::class)->reportSentryNotification($exception);
    }

    parent::report($exception);
}
```

## Alternatives

For advance usage, please consider using [laravel-notification-channels](https://github.com/laravel-notification-channels/telegram) instead.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Stan Man][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-telegram]: https://img.shields.io/badge/@PHPChatCo-2CA5E0.svg?style=flat-square&logo=telegram&label=Telegram
[ico-version]: https://img.shields.io/packagist/v/skater4/laravel-sentry-notifications.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/skater4/laravel-sentry-notifications.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/skater4/laravel-sentry-notifications.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/skater4/laravel-sentry-notifications.svg?style=flat-square
[link-telegram]: https://t.me/PHPChatCo
[link-repo]: https://github.com/skater4/laravel-sentry-notifications
[link-packagist]: https://packagist.org/packages/skater4/laravel-sentry-notifications
[link-scrutinizer]: https://scrutinizer-ci.com/g/skater4/laravel-sentry-notifications/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/skater4/laravel-sentry-notifications
[link-author]: https://github.com/skater4
[link-contributors]: ../../contributors
[link-notification-facade]: https://laravel.com/docs/8.x/notifications#using-the-notification-facade
[link-on-demand-notifications]: https://laravel.com/docs/8.x/notifications#on-demand-notifications
[link-telegram-docs-update]: https://core.telegram.org/bots/api#update
[link-telegram-docs-getupdates]: https://core.telegram.org/bots/api#getupdates
