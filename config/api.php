<?php

return [
    'use_goggle_api'     => env('USE_GOOGLE_API', true),
    'google'             => 'AIzaSyAcDyrxytH_vcuVEnpiVITBd42LcJODHqQ',
    'liqpay_public_key'  => env('LIQPAY_PUBLIC', ''),
    'liqpay_private_key' => env('LIQPAY_PRIVATE', ''),
    'dropbox'            => [
        'token'  => env('API_DROPBOX_TOKEN'),
        'key'    => env('API_DROPBOX_KEY'),
        'secret' => env('API_DROPBOX_SECRET')
    ]
];