<?php

return [
    'access_key_id' => env('DO_ACCESS_KEY_ID'),
    'secret_access_key' => env('DO_SECRET_ACCESS_KEY'),
    'default_region' => env('DO_DEFAULT_REGION', 'AMS3'),
    'bucket' => env('DO_BUCKET'),
    'cdn_endpoint' => env('DO_CDN_ENDPOINT'),
    'cdn_url' => env('DO_CDN_URL', 'https://ams3.digitaloceanspaces.com/'),
    'folder' => env('DO_FOLDER', '')
];