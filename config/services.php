<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'https://infaq.hidayahcentre.org.my/',
        'secret' => "{{Config::get('Settings.mail_user_password');}}",
        'endpoint' => "{{Config::get('Settings.mail_host');}}",
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	
	'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT')
    ],
	
	'facebook' => [
		'client_id' => '285715528575103',
		'client_secret' => '42aa2ebc236f88e447d5f8426809c628',
		'redirect' => 'http://localhost/spicymaster/handle-provider-callback/facebook',
	],
	
	'weibo' => [
		'client_id'     => '3925049366',
		'client_secret' => '681aa439196e0232b0098569df3683b9',
		'redirect'      => 'http://retreat.stage01.obdemo.com/spicymaster/handle-provider-callback/weibo',
	],
	
	
	'qq' => [
		'client_id' => env('QQ_KEY'),
		'client_secret' => env('QQ_SECRET'),
		'redirect' => env('QQ_REDIRECT_URI'),  
	], 

];
