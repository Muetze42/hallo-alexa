<?php

namespace App\Helpers\Socials;

use App\Models\Social;
use App\Notifications\Telegram\HtmlText;
use Illuminate\Support\Facades\Notification;

trait YouTube
{
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
}
