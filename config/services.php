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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],
    
   'pesapal' => [
    'consumer_key' => trim(env('PESAPAL_CONSUMER_KEY')),
    'consumer_secret' => trim(env('PESAPAL_CONSUMER_SECRET')),
    'callback_url' => trim(env('PESAPAL_CALLBACK_URL')),
    'base_url' => trim(env('PESAPAL_BASE_URL')),
    'query_url' => trim(env('PESAPAL_QUERY_URL')),
],



    'resend' => [
        'key' => env('RESEND_KEY'),
    ],
	
	'mpesa' => [
    'env' => env('MPESA_ENV', 'sandbox'),

    'sandbox' => [
        'consumer_key'    => env('MPESA_SANDBOX_CONSUMER_KEY'),
        'consumer_secret' => env('MPESA_SANDBOX_CONSUMER_SECRET'),
        'shortcode'       => env('MPESA_SANDBOX_SHORTCODE'),
        'passkey'         => env('MPESA_SANDBOX_PASSKEY'),
        'base_url'        => 'https://sandbox.safaricom.co.ke',
    ],

    'production' => [
        'consumer_key'    => env('MPESA_PROD_CONSUMER_KEY'),
        'consumer_secret' => env('MPESA_PROD_CONSUMER_SECRET'),

        // SAFARICOM CONFIRMED
        'shortcode'       => env('MPESA_PROD_SHORTCODE'), // Go-Live shortcode
        'till'            => env('MPESA_PROD_TILL'),      // Customer Till

        'passkey'         => env('MPESA_PROD_PASSKEY'),
        'base_url'        => 'https://api.safaricom.co.ke',
    ],

    'callback_url' => env('MPESA_CALLBACK_URL'),
],


    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
	
	'stripe' => [
    'secret' => env('STRIPE_SECRET'),
    'key' => env('STRIPE_KEY'),
],


    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
