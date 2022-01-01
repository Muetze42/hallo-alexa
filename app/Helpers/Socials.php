<?php

namespace App\Helpers;

use App\Helpers\Socials\Instagram;
use App\Helpers\Socials\TikTok;
use App\Helpers\Socials\YouTube;
use App\Models\Social;
use App\Notifications\Telegram\HtmlText;
use App\Notifications\Telegram\HtmlTextWithImage;
use App\Traits\ErrorExceptionNotify;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Notification;
use NormanHuth\RapidAPI\Social\Instagram28;
use NormanHuth\RapidAPI\Social\InstagramBestExperience;
use NormanHuth\RapidAPI\Social\InstagramBulkProfileScrapper;
use NormanHuth\RapidAPI\Social\InstagramProfile;
use NormanHuth\RapidAPI\Social\TikTokAllInOne;
use Illuminate\Support\Facades\Cache;

/**
 * Todo: Refactor OOP
 */
class Socials
{
    use ErrorExceptionNotify, Instagram, TikTok, YouTube;

    protected static int $telegramReceiver;
    protected static string $streamerName;

    public static function getReceiver(): int
    {
        if (empty(static::$telegramReceiver)) {
            if (config('app.env') == 'local') {
                static::$telegramReceiver = config('services.telegram-bot-api.receiver');
            }
            static::$telegramReceiver = config('services.telegram-bot-api.group_id');
        }

        return static::$telegramReceiver;
    }

    public static function getStreamerName(): string
    {
        if (empty(static::$streamerName)) {
            static::$streamerName = config('site.streamer-name');
        }

        return static::$streamerName;
    }

    /**
     * @param string $key
     * @param int $max
     * @return bool
     */
    protected static function cacheCheck(string $key, int $max): bool
    {
        $int = Cache::increment($key);

        return $int <= $max;
    }
}
