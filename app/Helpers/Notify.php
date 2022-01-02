<?php

namespace App\Helpers;

use App\Notifications\Telegram\ErrorReport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class Notify
{
    public static function sendTelegramErrorMessage($exception)
    {
        $key = 'error-report-notification';

        $status = Cache::get($key);

        if ($status != 'send') {
            Notification::send(681791255, new ErrorReport($exception));

            if(!$status) {
                Cache::add($key, 'send', config('site.error-report.throttle', 3600));
            }
        }
    }
}
