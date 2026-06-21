<?php

return [
    'default' => env('BROADCAST_DRIVER', 'null'),

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
                'host' => 'api-' . env('PUSHER_APP_CLUSTER', 'mt1') . '.pusher.com',
                'port' => 443,
                'scheme' => 'https'
            ],
        ],
    ],
];
