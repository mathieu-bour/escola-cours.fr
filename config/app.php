<?php
$config = [
    /*= Debug level
     *=====================================================*/
    'debug' => env('DEBUG', false),

    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'fr_FR'),
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        // 'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],

    'Security' => [
        'salt' => env('SECURITY_SALT', '348a753c67224c98e8ffc2e7145edd8dee1c4e7ae0387fc76ad08ab70e1438d3'),
    ],

    /*= Cache
     *=====================================================*/
    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
            'url' => env('CACHE_DEFAULT_URL', null),
        ],
        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'escola_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKECORE_URL', null),
        ],
        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'escola_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+1 years',
            'url' => env('CACHE_CAKEMODEL_URL', null),
        ],
    ],

    /*=  Errors
     *=====================================================*/
    'Error' => [
        'errorLevel' => E_ALL,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],

    /*= Email
     *=====================================================*/
    'EmailTransport' => [
        'default' => [
            'className' => 'Smtp',
            'host' => 'ssl://mathieu-bour.fr',
            'port' => 465,
            'timeout' => 30,
            'username' => 'contact@escola-cours.fr',
            'password' => 'QtAYbll7gfsmm0TOZHKO'
        ],
    ],
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'contact@escola-cours.fr',
            'sender' => 'contact@escola-cours.fr',
            'replyTo' => 'contact@escola-cours.fr',
            'charset' => 'utf-8',
            'headerCharset' => 'utf-8',
            'helpers' => ['Html']
        ],
    ],

    /*= Databases
     *=====================================================*/
    'Datasources' => [
        'dev' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'host' => '127.0.0.1',
            'username' => 'escola_cours_fr_dev',
            'password' => '*G3uf&6XJkvZP*429x01',
            'database' => 'escola_cours_fr_dev',
            'encoding' => 'utf8',
            'log' => true
        ],
        'live' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'host' => '127.0.0.1',
            'username' => 'escola_cours_fr',
            'password' => '*G3uf&6XJkvZP*429x01',
            'database' => 'escola_cours_fr',
            'encoding' => 'utf8',
            'log' => true
        ],
        'test' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => '127.0.0.1',
            'username' => 'escola_cours_fr_tests',
            'password' => '%T1!pnxuQlUQtr^&@vqy',
            'database' => 'escola_cours_fr_tests',
            'encoding' => 'utf8'
        ],
    ],

    /*= Debug
     *=====================================================*/
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
            'url' => env('LOG_DEBUG_URL', null),
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
            'url' => env('LOG_ERROR_URL', null),
        ],
    ],

    /*= Session
     *=====================================================*/
    'Session' => [
        'cookie' => 'session',
        'defaults' => 'php',
    ],

    'GoogleMapsAPI' => [
        'key' => 'AIzaSyCh6vG543HS6KI9ybwxLMWyUEfY88cWGcU'
    ]
];

return $config;
