<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Frizzle Redis Connection
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Frizzle will store the
    | meta information required for it to function. It includes a list of
    | topics, tokens, subscribers and other information.
    |
    */

    'use' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Frizzle Redis Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all Frizzle data in Redis. You
    | may modify the prefix when you are running multiple installations
    | of Frizzle on the same server so that they don't have problems.
    |
    */

    'prefix' => env('FRIZZLE_PREFIX', 'frizzle:'),

    /*
    |--------------------------------------------------------------------------
    | Frizzle Root Key
    |--------------------------------------------------------------------------
    |
    | TODO
    |
    */

    'root-key' => env('FRIZZLE_ROOT_KEY', 'frizzle'),

];
