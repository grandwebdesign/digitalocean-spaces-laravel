<?php

return [
    'digitalocean' => [
        'driver' => 's3',
        'key' => env('DO_ACCESS_KEY_ID'),
        'secret' => env('DO_SECRET_ACCESS_KEY'),
        'region' => env('DO_DEFAULT_REGION'),
        'bucket' => env('DO_BUCKET'),
        'cdn_endpoint' => env('DO_CDN_ENDPOINT'),
        'url' => env('DO_URL'),
        'endpoint' => env('DO_ENDPOINT'),
        'use_path_style_endpoint' => env('DO_USE_PATH_STYLE_ENDPOINT', false),
        'visibility' => 'public',
    ],
];
