<?php

namespace App\Helpers;

use App\Notifications\Telegram\HtmlText;
use App\Notifications\Telegram\HtmlTextWithImage;
use Illuminate\Support\Facades\Notification;

class Social
{
    public static function updateLatestYouTubeVideo()
    {
        $url = sprintf(
            'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=%s&maxResults=1&order=date&type=video&key=%s',
            config('services.youtube.channel_id'),
            config('services.youtube.api_key')
        );

        $content = file_get_contents($url);
        $data = json_decode($content, true);

        $videoId = $data['items'][0]['id']['videoId'];

        $youtube = \App\Models\Social::where([
            'provider'    => 'youtube',
            'provider_id' => $videoId,
        ])->first();
        if (!$youtube) {
            \App\Models\Social::updateOrCreate(
                ['provider' => 'youtube'],
                ['provider_id' => $videoId],
            );

            Notification::send(config('services.telegram-bot-api.group_id'), new HtmlText(__("Neues YouTube Video von Alexa\n\nhttps://www.youtube.com/watch?v=".$videoId)));
        }
    }

    public static function updateLatestInstagramPost()
    {
        $url = sprintf(
            'https://www.instagram.com/%s/?__a=1',
            config('services.instagram.profile')
        );

        $content = file_get_contents($url);
        $data = json_decode($content, true);

        $latest = !empty($data['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]['node']) ? $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][0]['node'] : '';

        if ($latest) {
            $instagram = \App\Models\Social::where([
                'provider'    => 'instagram',
                'provider_id' => $latest['shortcode'],
            ])->first();

            if (!$instagram) {
                \App\Models\Social::updateOrCreate(
                    ['provider' => 'instagram'],
                    [
                        'provider_id' => $latest['shortcode'],
                        'url'         => $latest['display_url'],
                    ],
                );

                Notification::send(config('services.telegram-bot-api.group_id'), new HtmlTextWithImage(__("Neuer Instagram-Beitrag von Alexa\n\nhttps://www.instagram.com/p/".$latest['shortcode']), $latest['display_url']));
            }
        } else {
            Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText(__('Instagram scrapp not possible on '.config('app.url'))));
        }
    }
}
