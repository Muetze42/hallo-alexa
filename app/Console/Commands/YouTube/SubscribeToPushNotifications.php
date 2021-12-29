<?php

namespace App\Console\Commands\YouTube;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SubscribeToPushNotifications extends Command
{
    protected string $subscribeUrl = 'https://pubsubhubbub.appspot.com/subscribe';
    protected string $topicUrl = 'https://www.youtube.com/xml/feeds/videos.xml?channel_id=';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to YouTube Push Notifications';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $data = [
            'hub.mode'          => 'subscribe',
            'hub.callback'      => route('api.youtube.subscribe'),
            'hub.lease_seconds' => 60 * 60 * 24 * 365,
            'hub.topic'         => $this->topicUrl.config('services.youtube.channel_id'),
        ];

        $opts = ['http' =>
                     [
                         'method'  => 'POST',
                         'header'  => 'Content-type: application/x-www-form-urlencoded',
                         'content' => http_build_query($data)
                     ]
        ];

        $context = stream_context_create($opts);

        file_get_contents($this->subscribeUrl, false, $context);

        Log::info('Subscribe to YouTube Push Notifications: '.$http_response_header[0]);

        return 0;
    }
}
