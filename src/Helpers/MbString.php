<?php

namespace Skater4\LaravelSentryNotifications\Helpers;

/*
 * Adds support for Russian symbols
 */
class MbString
{
    /**
     * @param string $string
     * @return string
     */
    public static function mbUcfirst(string $string): string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }
}
