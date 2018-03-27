<?php

use Monolog\Handler\StreamHandler;
use Gmsantos\Monolog\Handler\InsightOpsHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    | Available Settings: "single", "daily", "syslog", "errorlog"
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'slack'],
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 7,
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],

        'stdout' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stdout',
            ],
        ],

        'insightops' => [
            'driver' => 'monolog',
            'handler' => InsightOpsHandler::class,
            'with' => [
                'token' => env('INSIGHTOPS_TOKEN'),
            ],
        ],

        'queue' => [
            'driver' => 'monolog',
            'handler' => InsightOpsHandler::class,
            'with' => [
                'token' => env('INSIGHTOPS_TOKEN'),
            ],
        ],

        'api' => [
            'driver' => 'monolog',
            'handler' => InsightOpsHandler::class,
            'with' => [
                'token' => env('INSIGHTOPS_TOKEN'),
            ],
        ],
    ],

];
