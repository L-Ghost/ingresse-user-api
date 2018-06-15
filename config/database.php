<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),
    'migrations' => 'migrations',

    'connections' => [
        env('DB_CONNECTION', 'mysql') => [ /// production
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        env('TEST_DB_CONNECTION', 'mysql_testing') => [ /// testing database
            'driver'    => 'mysql',
            'host'      => env('TEST_DB_HOST'),
            'port'      => env('TEST_DB_PORT'),
            'database'  => env('TEST_DB_DATABASE'),
            'username'  => env('TEST_DB_USERNAME'),
            'password'  => env('TEST_DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
    ],

];