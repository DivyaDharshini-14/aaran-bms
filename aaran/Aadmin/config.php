<?php

return [

    // software version => software version . sub version . database . git . app code

    'soft_version' => '1.0.0.196.100',

    'current_acyear' => '2024_25',

    'app_type' => env('APP_TYPE', '1'),

    'app_code' => env('APP_CODE', '1'),

    'brand' => env('BRAND', 'CODEXSUN'),

    'main_menu' => [
        ['menu' => 'home', 'link' => 'home'],
        ['menu' => 'Gallery', 'link' => 'gallery'],
        ['menu' => 'News', 'link' => 'news'],
        ['menu' => 'Blog', 'link' => 'feed'],
        ['menu' => 'About', 'link' => 'sportAbout'],
        ['menu' => 'Contact', 'link' => 'sportContact'],
    ]
];
