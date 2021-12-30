<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hallo Alexa Settings
    |--------------------------------------------------------------------------
    |
    | Specific settings for this app
    |
    */
    'open-graph' => [
        'fallback-image' => 'img/fallback.jpg',
    ],
    'count_delay' => env('LINK_COUNT_DELAY',240) > 10 ? env('LINK_COUNT_DELAY') : 10,
    'nova' => [
        'external_link_class' => 'no-underline dim text-primary',
        'external_link_icon' => 'fa-fw fal fa-external-link fa-xs',
    ],
    'error-report' => [
        'throttle' => 3600,
    ],
    'streamer-name' => env('STREAMER_NAME', 'Alexa'),
];
