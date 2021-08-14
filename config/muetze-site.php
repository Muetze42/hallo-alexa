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
        'migration'      => false,
        'policy'         => true,
        'resource'       => true,
        'controller'     => false,
        'api-controller' => false,

        'namespaces' => [
            'controller'     => '',
            'api-controller' => 'Api/',
        ],
    ],
];
