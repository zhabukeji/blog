<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'session' => [
            'name' => 'advanced-frontend',
            'class' => 'yii\redis\Session'
        ],

    ],
];
