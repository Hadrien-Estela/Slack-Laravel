<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Slack API endpoint
    |--------------------------------------------------------------------------
    |
    | Slack API url.
    | You may not change this value
    |
    */

    'api_url' => 'https://slack.com/api/',

    /*
    |--------------------------------------------------------------------------
    | Signing secret
    |--------------------------------------------------------------------------
    |
    | Slack signs the requests we send you using this secret.
    | Confirm that each request comes from Slack by verifying its unique signature.
    |
    */

    'signing_secret' => env('SLACK_SIGNING_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Tokens
    |--------------------------------------------------------------------------
    |
    | The tokens used by your app to authenticate through the slack API.
    |
    */

    'tokens' => [
        'oauth' => env('SLACK_TOKEN_OAUTH'),
        'bot' => env('SLACK_TOKEN_BOT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Channels
    |--------------------------------------------------------------------------
    |
    | The channels ID you want to bind to the service.
    |
    */

    'channels' => [
        'default' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhooks
    |--------------------------------------------------------------------------
    |
    | The webhooks urls.
    |
    */

    'webhooks' => [
        'default' => ''
    ],

];
