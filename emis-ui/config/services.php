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
    'api_gateway' => [
        'base_uri' => env('API_GATEWAY_SERVICE_BASE_URL'),
    ],

    'login_logout'=>[
        'logout_uri' => env('SYSTEM_REDIRECTION_URL')
    ],

    'constant'=>[
        'file_stored_base_path' => env('FILE__BASE_PATH'),
        'notification_leadership_selection_applicaiton' => env('APPLICATION_SUBMISSION_FOR_LEADERSHIP_SELECTION'),
        'hrd_role_id'=> env('HRD_ROLE_ID'),
        'deo_role_id'=> env('DEO_ROLE_ID'),
        'emd_role_id'=> env('EMD_ROLE_ID'),


    ],

];
