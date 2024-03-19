<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stripe API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key provided by Stripe. This value is used when
    |
    | Supported: "file", "cookie", "database", "apc",
    |
    */

    'stripe_api' => [
        'secret' => env('STRIPE_SECRET_KEY'),
        'public' => env('STRIPE_PUBLISHABLE_KEY'),
    ],

];