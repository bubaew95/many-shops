<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=shops',
            'username' => 'root',
            'password' => '',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
