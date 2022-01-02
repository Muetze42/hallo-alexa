<?php

namespace App\Helpers\Socials;

use App\Models\Social;
use App\Notifications\Telegram\HtmlTextWithImage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Notification;
use NormanHuth\RapidAPI\Social\Instagram28;
use NormanHuth\RapidAPI\Social\InstagramBestExperience;
use NormanHuth\RapidAPI\Social\InstagramBulkProfileScrapper;
use NormanHuth\RapidAPI\Social\InstagramProfile;

trait Instagram
{
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
    protected static function instaMethod1(): bool
    {
        $instagram = new InstagramProfile;
        $data = $instagram->getFeed(config('services.instagram.profile'));

        $content = json_decode($data, true);
        if (!empty($content['media'][0])) {
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
    public static function instaMethod2(): bool
    {
        if (static::cacheCheck('instagram-bulk-profile-scrapper', 250)) {
            $instagram = new InstagramBulkProfileScrapper;

            $data = $instagram->getFeedByUsername(config('services.instagram.profile'));

            $content = json_decode($data, true);

            $last = $content[0]['feed']['data'][0];
            $shortcode = $last['code'];
            $image = static::getImageByItems($last);
            if ($image) {
                static::instaNotify($shortcode, $image);

                return true;
            }
        }

        return false;
    }

    protected static function getImageByItems(array $last): ?string
    {
        if (!empty($last['image_versions2']['candidates'][1]['url'])) {
            return $last['image_versions2']['candidates'][1]['url'];
        } else if (!empty($last['carousel_media'][0]['image_versions2']['candidates'][1]['url'])) {
            return $last['carousel_media'][0]['image_versions2']['candidates'][1]['url'];
        }

        return null;
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
            $image = static::getImageByItems($last);
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
