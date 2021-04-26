<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class'     => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache' // Храним кэш в common/runtime/cache
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
//        'session' => [
//            'class' => 'yii\web\DbSession',
//        ],
    ],
];
