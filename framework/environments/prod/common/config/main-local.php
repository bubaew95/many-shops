<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mirvoditel_tr',
            'username' => 'mirvoditel_tr',
            'password' => '4dUH&rmq',
            'charset' => 'utf8',

            'enableSchemaCache' => true,
            // Продолжительность кеширования схемы.
            'schemaCacheDuration' => 3600,
            // Название компонента кеша, используемого для хранения информации о схеме
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
