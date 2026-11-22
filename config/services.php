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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // eSewa ePay v2. The defaults are eSewa's public test credentials (no real money moves).
    // Set ESEWA_ENVIRONMENT=production with your merchant product code and secret key to go live.
    'esewa' => [
        'environment' => env('ESEWA_ENVIRONMENT', 'test'),
        'product_code' => env('ESEWA_PRODUCT_CODE', 'EPAYTEST'),
        'secret_key' => env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q'),
        'appointment_fee' => (float) env('ESEWA_APPOINTMENT_FEE', 500),
    ],

];
