<?php

namespace App\Helpers;

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

class Socials
{
    use ErrorExceptionNotify;

    public static function getReceiver()
    {
        if (config('app.env') == 'local') {
            return config('services.telegram-bot-api.receiver');
        }
        return config('services.telegram-bot-api.group_id');
    }

    public static function getStreamerName()
    {
        return config('site.streamer-name');
    }

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

    public static function updateLatestYouTubeVideo()
    {
        $url = sprintf(
            'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=%s&maxResults=50&order=date&type=video&key=%s',
            config('services.youtube.channel_id'),
            config('services.youtube.api_key')
        );

        $content = file_get_contents($url);
        $data = json_decode($content, true);

        $items = $data['items'];

        foreach ($items as $item) {
            $videoId = $item['id']['videoId'];
            $liveBroadcastContent = $item['snippet']['liveBroadcastContent'];
            #$title = $item['snippet']['title'];

            if ($liveBroadcastContent != 'upcoming') {
                $youtube = Social::where([
                    'provider'    => 'youtube',
                    'provider_id' => $videoId,
                ])->first();
                if (!$youtube) {
                    if (!auth()->check()) {
                        activity()->disableLogging();
                    }
                    Social::updateOrCreate(
                        ['provider' => 'youtube'],
                        ['provider_id' => $videoId],
                    );

                    Notification::send(static::getReceiver(), new HtmlText(
                        __('New video by :name', ['name' => static::getStreamerName()])."\n\n\nhttps://www.youtube.com/watch?v=".$videoId
                    ));
                }

                break;
            }
        }
    }

    /**
     * @throws GuzzleException
     */
    public static function updateLatestInstagramPost()
    {
        if (static::instaMethod1()) {
            return;
        }
        if (static::instaMethod2()) {
            return;
        }
        if (static::instaMethod3()) {
            return;
        }
        if (static::instaMethod4()) {
            return;
        }
        if (static::instaMethodLast()) {
            return;
        }

        static::sendErrorMessageViaTelegram('Update last Instagram Post failed');
    }

    /**
     * @throws GuzzleException
     */
    public static function instaMethod2(): bool
    {
        if (static::cacheCheck('instagram-bulk-profile-scrapper', 250)) {
            $instagram = new InstagramBulkProfileScrapper;

            $data = $instagram->getFeedByUsername(config('services.instagram.profile'));

            $content = json_decode($data, true);

            $last = $content[0]['feed']['data'][0];
            $shortcode = $last['code'];
            if (!empty($last['image_versions2']['candidates'][1]['url'])) {
                $image = $last['image_versions2']['candidates'][1]['url'];
            } else if (!empty($last['carousel_media'][0]['image_versions2']['candidates'][1]['url'])) {
                $image = $last['carousel_media'][0]['image_versions2']['candidates'][1]['url'];
            }
            if ($image) {
                static::instaNotify($shortcode, $image);

                return true;
            }
        }

        return false;
    }

    /**
     * @throws GuzzleException
     */
    public static function instaMethod4(): bool
    {
        if (static::cacheCheck('instagram-best-experience', 50)) {
            $instagram = new InstagramBestExperience;

            $data = $instagram->getUserFeed(config('services.instagram.id'));

            $content = json_decode($data, true);

            $last = $content['items'][0];
            $shortcode = $last['shortcode'];
            $image = '';
            if (!empty($last['image_versions2']['candidates'][1]['url'])) {
                $image = $last['image_versions2']['candidates'][1]['url'];
            } else if (!empty($last['carousel_media'][0]['image_versions2']['candidates'][1]['url'])) {
                $image = $last['carousel_media'][0]['image_versions2']['candidates'][1]['url'];
            }
            if ($image) {
                static::instaNotify($shortcode, $image);

                return true;
            }
        }

        return false;
    }

    /**
     * @throws GuzzleException
     */
    public static function instaMethod3(): bool
    {
        if (static::cacheCheck('instagram28', 20)) {
            $instagram = new Instagram28;

            $data = $instagram->getMedias(config('services.instagram.id'));

            $content = json_decode($data, true);

            if (!empty($content['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node'])) {
                $last = $content['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node'];
                $shortcode = $last['shortcode'];
                $image = $last['display_url'];

                static::instaNotify($shortcode, $image);

                return true;
            }
        }

        return false;
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

    /**
     * @throws GuzzleException
     */
    protected static function instaMethod1(): bool
    {
        $instagram = new InstagramProfile;
        $data = $instagram->getFeed(config('services.instagram.profile'));

        $content = json_decode($data, true);
        if (!empty($content['media'][0]['shortcode'])) {
            $shortcode = $content['media'][0]['shortcode'];
            $image = $content['media'][0]['display_url'];

            static::instaNotify($shortcode, $image);

            return true;
        }

        return false;
    }

    /**
     * @throws GuzzleException
     */
    protected static function instaMethodLast(): bool
    {
        $client = new Client;

        $url = sprintf('https://instagram.com/%s/channel/?__a=1', config('services.instagram.profile'));

        $res = $client->request('GET', $url, [
            'http_errors' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36'
            ]
        ]);

        $status = $res->getStatusCode();
        $content = $res->getBody()->getContents();
        //$headers = $res->getHeaders();

        if ($status >= 200 && $status < 300) {
            $data = json_decode($content, true);

            if (!empty($data['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]['node'])) {
                $lastMedia = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]['node'];

                $shortcode = $lastMedia['shortcode'];
                $image = $lastMedia['display_url'];

                static::instaNotify($shortcode, $image);

                return true;
            }
        }

        return false;
    }

    protected static function instaNotify(string $shortCode, string $image)
    {
        $instagram = Social::where([
            'provider'    => 'instagram',
            'provider_id' => $shortCode,
        ])->first();

        if (!$instagram) {
            if (!auth()->check()) {
                activity()->disableLogging();
            }
            Social::updateOrCreate(
                ['provider' => 'instagram'],
                [
                    'provider_id' => $shortCode,
                    'url'         => $image,
                ],
            );

            Notification::send(static::getReceiver(), new HtmlTextWithImage(
                    __('New Instagram Post by :name', ['name' => static::getStreamerName()])."\n\nhttps://www.instagram.com/p/".$shortCode
                    , $image)
            );
        }
    }
}
