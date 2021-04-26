<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\user\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
//                'yii\web\JqueryAsset' => [
//                    'js'=>[]
//                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ],

                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/module/rbac/messages',
                ],

                'eav' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/modules/eav/backend/messages',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/shops/default/index',
                '<shop_id:\d+>' => 'site/info',

                '<shop_id:\d+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<shop_id:\d+>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/view',

                '<shop_id:\d+>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<shop_id:\d+>/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

                '<shop_id:\d+>/eav/admin/ajax/<action:\w+>' => 'eav/admin/ajax/<action>',

                [
                    'class' => 'backend\components\AnyParamsRule',
                    'pattern' => 'shops/default',
                    'route'=>'blog/default',
                ],
            ],
        ],

        'settings' => [
            'class' => 'pheme\settings\components\Settings',
            'cache'=>['class'=>'yii\caching\FileCache'],
        ],

        'shopComponent' => \common\components\ShopComponent::class,
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],

        'rbac'      => \backend\module\rbac\Module::class,
        'locations' => \backend\module\locations\Location::class,
        'shops'     => \common\modules\shops\backend\ShopsModule::class,
        'menu'      => \common\modules\categories\backend\CategoriesModule::class,
        'products'  => \common\modules\products\backend\ProductsModule::class,
        'orders'    => \common\modules\orders\backend\OrdersModule::class,
        'eav'       => \common\modules\eav\backend\Module::class,
    ],

    'params' => $params,
];
