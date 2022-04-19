<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    |
    | This value is the model of your visitor tracker table.
    */

    'model' => \Drsoft\VisitorTracker\Models\VisitorTracker::class,

    /*
    |--------------------------------------------------------------------------
    | Headers
    |--------------------------------------------------------------------------
    |
    | This value is array of varaible name in $_SERVER which you liked to save it in vistor tracker table.
    */

    'headers' => [
        'HTTP_USER_AGENT',
        'HTTP_HOST',
        'SERVER_NAME',
        'SERVER_SOFTWARE',
        'REMOTE_ADDR',
        'HTTPS',
    ],

    /*
    |--------------------------------------------------------------------------
    | Route
    |--------------------------------------------------------------------------
    |
    | This value is array of route name which will expect from tracking, you can use backend.* as
    | routes name are start witu 'name.'.
    */

    'routes' => [
        //'backend.*',
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | This value is array of uri which will expect from tracking, you can use backend/* as
    | routes name are start witu 'name.'.
    */

    'paths' => [
        //'backend/*',
    ],
];