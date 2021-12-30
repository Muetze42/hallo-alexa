<?php

namespace App\Http\Controllers\Api\YouTube;

use App\Http\Controllers\Controller;
use App\Helpers\Social;
use App\Notifications\Telegram\HtmlText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PushNotificationsController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function get(Request $request): string
    {
        $hubChallenge = $request->get('hub_challenge');
        if ($hubChallenge) {
            return $hubChallenge;
        }

        return '';
    }


    /**
     * @param Request $request
     * @return string
     */
    public function post(Request $request): string
    {
        $hubChallenge = $request->get('hub_challenge');
        if ($hubChallenge) {
            return $hubChallenge;
        }

        $payload = $request->getContent();

        $xml = simplexml_load_string($payload, 'SimpleXMLElement', LIBXML_NOCDATA);
        $parts = explode(':', $xml->entry->id);
        $videoId = end($parts);

        if ($videoId) {
            Social::updateLatestYouTubeVideo();
        } else {
            Log::info('No Video ID - Payload: '.$payload);
            Notification::send(config('services.telegram-bot-api.receiver'), new HtmlText("No Video ID - Payload: \n\n".$payload));
        }

        return '';
    }
}
