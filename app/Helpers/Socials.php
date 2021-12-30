<?php

namespace App\Helpers;

use App\Models\Social;
use App\Notifications\Telegram\HtmlText;
use App\Notifications\Telegram\HtmlTextWithImage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use NormanHuth\RapidAPI\Social\InstagramProfile;
use NormanHuth\RapidAPI\Social\TikTokAllInOne;

class Socials
{
    public static function getReceiver()
    {
        //return config('services.telegram-bot-api.receiver'); // Debug
        return config('services.telegram-bot-api.group_id');
    }

    public static function getStreamerName()
    {
        return config('muetze-site.streamer-name');
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
            Social::updateOrCreate(
                ['provider' => 'tiktok'],
                [
                    'provider_id' => $latest['aweme_id'],
                    'url' => $latest['video']['cover']['url_list'][0],
                ]
            );

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
        static::instaMethod2();
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
    protected static function instaMethod2(): bool
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
        $headers = $res->getHeaders();

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

        Log::error('Helper\\Social::instaMethod1() failed:'.print_r([
                'status' => $status,
                'content' => $content,
                'headers' => $headers,
            ], true));

        return false;
    }

    protected static function instaNotify(string $shortCode, string $image)
    {
        $instagram = Social::where([
            'provider'    => 'instagram',
            'provider_id' => $shortCode,
        ])->first();

        if (!$instagram) {
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
