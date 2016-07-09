<?php


return [

    'service'   => 'local',

    'levels' => ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR', 'WARNING', 'NOTICE', 'INFO', 'DEBUG'],

    'channels' => ['log', 'user.register', 'user.login', 'user.activation', 'action.failed'],

    'notification' => ['user.fail' => ['CRITICAL', 'ALERT'], 'user.register' => ['NOTICE'], 'user.login' => ['NOTICE'],],

    'mail_subject' => 'gLogger notification mail',

    'mail_to' => env('MAIL_FROM', null),
    'translations' => [
        'action.failed' => 'Action failed',
        'user.register' => 'A new user registered',
        'log'   => 'LOG',
    ],
    'route-prefix' => 'logs',
];


