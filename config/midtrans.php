<?php

return [

    'server_key' => env('MIDTRANS_SERVER_KEY'),

    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    /*
    |--------------------------------------------------------------------------
    | Demo Mode
    |--------------------------------------------------------------------------
    | When true (or server key is empty), checkout/donation completes instantly
    | without opening Midtrans Snap — useful for local dev and automated tests.
    */
    'demo_mode' => env('MIDTRANS_DEMO_MODE', false),

];
