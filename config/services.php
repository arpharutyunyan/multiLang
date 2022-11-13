<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '339196432963-ebia7085aat6u8knfcsm13ukfkpvtcte.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/google/callback'
    ],

    'facebook' => [
        'client_id' => '833614251011391',
        'client_secret' => '9e1ebb646097adc3e224bfdf47dec96b',
        'redirect' => 'http://localhost:8000/callback',
    ],

];
