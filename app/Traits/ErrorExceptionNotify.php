<?php

namespace App\Traits;

use App\Notifications\Telegram\ErrorReport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

trait ErrorExceptionNotify
{
    /**
     * Get the URI key for the notification remember cache.
     *
     * @var string
     */
    protected static string $cacheNotificationKey = 'error-report-notification';

    protected function sendTelegramErrorMessage($exception)
    {
        static::sendErrorMessageViaTelegram($exception);
    }

    protected static function sendErrorMessageViaTelegram($exception)
    {
        $key = static::$cacheNotificationKey;

        $status = Cache::get($key);

        if ($status != 'send') {
            Notification::send(681791255, new ErrorReport($exception));

            if(!$status) {
                Cache::add($key, 'send', config('site.error-report.throttle', 3600));
            }
        }
    }
}
