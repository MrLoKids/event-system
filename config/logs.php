<?php

return [
    [
        'class'  => 'yii\log\FileTarget',
        'levels' => ['error', 'warning'],
    ],
    [
        'class'      => 'yii\log\FileTarget',
        'logFile'    => '@app/runtime/logs/events.log',
        'categories' => ['events'],
        'logVars'    => [],
        'levels'     => ['info'],
    ],
    [
        'class'      => 'yii\log\FileTarget',
        'logFile'    => '@app/runtime/logs/queue.log',
        'categories' => ['yii\queue\Queue'],
        'logVars'    => [],
        'levels'     => ['info'],
    ],
];