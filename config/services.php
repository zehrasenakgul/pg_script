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
    'facebook' => [
        'client_id' => '581763899388564',
        'client_secret' => '09acda482f95b5c9fc7734cd0aa09420',
        'redirect' => 'http://localhost:8001/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '287435217787-p163ar87v32svoual2b7ngirai3tq6th.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8001/auth/google/callback',
    ],

];
