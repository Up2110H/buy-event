<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@db' => '@app/db',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'sms' => [
            'class' => 'wadeshuler\sms\twilio\Sms',

            // send all sms to a file by default. You have to set
            // 'useFileTransport' to false and configure the messageConfig['from'],
            // 'sid', and 'token' to send real messages
            'useFileTransport' => true,

            // Find your Account Sid and Auth Token at https://twilio.com/console
            'sid' => 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'token' => 'your_auth_token',

            // Tell Twilio where to POST information about your message.
            // @see https://www.twilio.com/docs/sms/send-messages#monitor-the-status-of-your-message
            //'statusCallback' => 'https://example.com/path/to/callback',      // optional
        ],
    ],
    'params' => $params,
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
}

return $config;
