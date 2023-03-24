<?php

use yii\queue\file\Queue;
use yii\queue\LogBehavior;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id'                  => 'basic-console',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log', 'queue'],
    'controllerNamespace' => 'app\commands',
    'aliases'             => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components'          => [
        'queue' => [
            'class'  => Queue::class,
            'as log' => LogBehavior::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log'   => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class'   => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/events.log',
                    'logVars' => [],
                    'levels'  => ['info'],
                ],
            ],
        ],
        'db'    => $db,
    ],
    'params'              => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
