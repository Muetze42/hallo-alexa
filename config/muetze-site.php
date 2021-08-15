<?php

return [
    /*
    |--------------------------------------------------------------------------
    | make:bundle command
    |--------------------------------------------------------------------------
    |
    | What should be generated without option?
    |
    */
    'make-bundle' => [
        'nova-ressource' => true,
        'migration'      => true,
        'policy'         => true,
        'resource'       => true,
        'controller'     => false,
        'api-controller' => false,

        'namespaces' => [
            'controller'     => '',
            'api-controller' => 'Api/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hallo Alexa Settings
    |--------------------------------------------------------------------------
    |
    | Specific settings for this app
    |
    */
    'count_delay' => env('LINK_COUNT_DELAY',240) > 10 ? env('LINK_COUNT_DELAY') : 10,
];
