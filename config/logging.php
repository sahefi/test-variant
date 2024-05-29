<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'tap' => [\App\Logging\FormatLog::class],
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'formatter_with' => [
                'allowInlineLineBreaks' => true
            ]
        ],

        'daily' => [
            'driver' => 'daily',
            'tap' => [\App\Logging\FormatLog::class],
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
            'formatter_with' => [
                'allowInlineLineBreaks' => true
            ]
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'tap' => [\App\Logging\FormatLog::class],
            'path' => storage_path('logs/laravel.log'),
            'formatter_with' => [
                'allowInlineLineBreaks' => true
            ]
        ],

        'loki' => [
            'driver'    => 'custom',
            'level'     => env('LOG_LEVEL', 'debug'),
            'handler'   => Wahyuagung\MonologLoki\LokiHandler::class,
            'formatter' => Wahyuagung\MonologLoki\LokiFormatter::class,
            'via'       => Wahyuagung\MonologLoki\LokiNoFailureHandler::class,
            'formatter_with' => [
                'labels' => ['project' => env('APP_NAME', '')],
                'context' => [],
                'systemName' => env('LOKI_SYSTEM_NAME', ''),
                'extraPrefix' => env('LOKI_EXTRA_PREFIX', ''),
                'contextPrefix' => env('LOKI_CONTEXT_PREFIX', '')
            ],
            'handler_with'   => [
                'apiConfig'  => [
                    'entrypoint'  => env('LOKI_ENTRYPOINT'),
                    'context'     => [],
                    'labels'      => [],
                    'client_name' => '',
                    'auth' => [
                        'basic' => [
                            env('LOKI_AUTH_BASIC_USER', ''),
                            env('LOKI_AUTH_BASIC_PASSWORD', '')
                        ],
                    ]
                ],
            ],
        ],
    ],
];
