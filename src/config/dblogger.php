<?php


return [
    'service'  => 'local',
    'api_key'   => '123456789',
    'remote_host'   => 'http://homestead.app/api/log',
    'levels' => ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR', 'WARNING', 'NOTICE', 'INFO', 'DEBUG'],
    'channels' => ['dblogger', 'user.register', 'user.login', 'user.activation'],
    'notification' => ['user.fail' => ['CRITICAL', 'ALERT'], 'user.register' => ['NOTICE'], 'user.login' => ['NOTICE'],],
    'mail_subject' => 'DbLogger notification mail',
    'mail_to' => env('MAIL_FROM', null),
    'messages' => [
        'user.fail' => 'A user failed',
        'user.register' => 'A new user registered',
    ]
];


