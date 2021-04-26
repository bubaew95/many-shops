<?php


$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'MirVoditeley',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'language' => 'ru',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\user\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['/auth/login']
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'http://<alias:\w+>.berkatchr.ru' => 'shops/info/index',
                's/<alias:\w+>' => 'shops/info/index',
                ''              => 'site/index',
                'user'          => 'user/index',
                'defaultRoute'  => '/site/index',
                'catalog/<alias:([a-z_A-Z-0-9+]+)>-<id:\d+>' => 'catalog/view/index',
                'catalog/<alias:([a-z_A-Z-0-9+]+)>' => 'catalog/default/index',

                '<module:\w+>' => '<module>/default/index',
                '<module:\w+>' => '<module>/default',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

                '<alias:\w+>' => 'menu/category',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                ['pattern' => 'sitemap', 'route' => 'sitemap', 'suffix' => '.xml'],
                ['pattern' => 'yandex_turbo', 'route' => 'yandexTurbo/yandex-turbo/index', 'suffix' => '.xml'],
            ],
        ],

        'assetManager' => [
            'assetMap' => [
//                'yii.js'                => 'framework/yii.js',
//                'yii.activeForm.js'     => 'framework/activeForm.js',
//                'activeform.js'         => 'framework/activeforms.js',
//                'yii.validation.js'     => 'framework/validation.js',
//                'jquery.js'             => 'framework/jquery.js'
            ],
            'bundles' => [
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

        'settings' => [
            'class' => 'pheme\settings\components\Settings',
            'cache' => ['class'=>'yii\caching\FileCache'],
        ],
        'view' => [
            'class' => '\common\components\View',
        ],

        'shopComponent' => \common\components\ShopComponent::class
    ],

    'modules' => [

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                // your models
                \common\models\pages\Pages::className()
                // or configuration for creating a behavior
            ],
            'urls'=> [
                // your additional urls
                [
                    'loc' => '/',
                    'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.9,
                    'images' => [
                        [
                            'loc'           => '/images/logo.png',
                            'caption'       => 'Быстрый поиск водителей и работы. Разместить вакансии. Разместить резюме.',
                            'geo_location'  => 'Москва',
                            'title'         => 'MirVoditeley.ru',
                        ],
                    ],
                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
//        'yandexTurbo' => [
//            'class' =>  \lan143\yii2_yandexturbo\YandexTurbo::class,
//            'title' => 'Liftoff News', // not required, default Application name
//            'link' => 'http://liftoff.msfc.nasa.gov/', // not required, default Url::home
//            'description' => 'Liftoff to Space Exploration.', // default empty
//            'language' => 'en-us', // not required, default Application language
//            'elements' => [
//                // only model class. Need behavior in model
//                \common\models\adv\Vacancy::class,
//                // or configuration for creating a behavior
//                // or configure static content
//                [
//                    'title' => 'About page',
//                    'link' => ['/about'],
//                    'description' => 'This is about page',
//                    'content' => 'Some content of about page, will be displayed in Yandex Turbo page. You can use <strong>html<strong> tags.',
//                    'pubDate' => (new \DateTime('2018-01-26 18:57:00'))->format(\DateTime::RFC822)
//                ],
//            ],
//            'cacheExpire' => 1, // 1 second. Default is 15 minutes
//        ],

        'shops'     => \common\modules\shops\frontend\ShopsModule::class,
        'catalog'   => \common\modules\products\frontend\ProductsModule::class,
    ],

    'params' => $params,
];
