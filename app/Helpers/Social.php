<?php

namespace App\Helpers;

use App\Notifications\Telegram\HtmlText;
use App\Notifications\Telegram\HtmlTextWithImage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Notification;
use InstagramScraper\Exception\InstagramAuthException;
use InstagramScraper\Exception\InstagramChallengeRecaptchaException;
use InstagramScraper\Exception\InstagramChallengeSubmitPhoneNumberException;
use InstagramScraper\Exception\InstagramException;
use InstagramScraper\Exception\InstagramNotFoundException;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
use Psr\SimpleCache\InvalidArgumentException;

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

    /**
     * @throws InstagramChallengeRecaptchaException
     * @throws InstagramChallengeSubmitPhoneNumberException
     * @throws InstagramNotFoundException
     * @throws InstagramAuthException
     * @throws InstagramException
     * @throws InvalidArgumentException
     */
    public static function updateLatestInstagramPost()
    {
        $instagram = Instagram::withCredentials(
            new Client(),
            config('services.instagram.login'),
            config('services.instagram.password'),
            new Psr16Adapter('Files')
        );
        $instagram->login();
        $instagram->saveSession();
        $medias = $instagram->getMedias(config('services.instagram.profile'), 1);

        if (!empty($medias[0])) {
            $shortCode = $medias[0]['shortCode'];
            $link = $medias[0]['link'];
            $image = $medias[0]['imageLowResolutionUrl'];

            $instagram = \App\Models\Social::where([
                'provider'    => 'instagram',
                'provider_id' => $shortCode,
            ])->first();

            if (!$instagram) {
                \App\Models\Social::updateOrCreate(
                    ['provider' => 'instagram'],
                    [
                        'provider_id' => $shortCode,
                        'url'         => $image,
                    ],
                );

                Notification::send(config('services.telegram-bot-api.group_id'), new HtmlTextWithImage(__("Neuer Instagram-Beitrag von Alexa\n\n".$link), $image));
            }
        } else {
            Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText(__('Instagram scrapp not possible on '.config('app.url'))));
        }
    }
}
