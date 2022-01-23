<?php

namespace App\Helpers\Socials;

use App\Models\Social;
use App\Notifications\Telegram\HtmlText;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use NormanHuth\RapidAPI\Social\TikTokAllInOne;

trait TikTok
{
    /**
     * @throws GuzzleException
     */
    public static function updateLatestTikTok()
    {
        $api = new TikTokAllInOne;
        $data = $api->getUserVideos(config('services.tiktok.user_id'));

        $content = json_decode($data, true);
        $time = 0;
        $latest = [];

        if (empty($content['aweme_list'])) {
            Log::error('Empty aweme_list');
            return;
        }

        $items = $content['aweme_list'];
        foreach ($items as $item) {
            if ($item['create_time'] < $time) {
                continue;
            }
            $time = $item['create_time'];
            $latest = $item;
        }

        $tikTok = Social::where([
            'provider'    => 'tiktok',
            'provider_id' => $latest['aweme_id'],
        ])->first();

        if (!$tikTok) {
            if (!auth()->check()) {
                activity()->disableLogging();
            }

            Social::updateOrCreate(
                ['provider' => 'tiktok'],
                ['provider_id' => $latest['aweme_id']]
            );

            foreach ($latest['video']['cover']['url_list'] as $image) {
                if (str_contains($image, '.jpeg') || str_contains($image, '.jpg')) {
                    $target = storage_path('app/public/tiktok.jpg');
                    file_put_contents($target, file_get_contents($image));
                }
            }

            $url = sprintf(
                'https://www.tiktok.com/@%s/video/%d',
                config('services.tiktok.user_name'),
                $latest['aweme_id'],
            );

            Notification::send(static::getReceiver(), new HtmlText(
                __('New TikTok by :name', ['name' => static::getStreamerName()])."\n\n\n".$url
            ));
        }
    }
}
