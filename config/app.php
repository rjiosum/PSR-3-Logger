<?php declare(strict_types=1);
return [
    'name' => getenv('APP_NAME'),
    'env' => getenv('APP_ENV'),
    'debug' => getenv('APP_DEBUG'),
    'url' => getenv('APP_URL'),
    'log' => [
        'path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'log',
    ]
];