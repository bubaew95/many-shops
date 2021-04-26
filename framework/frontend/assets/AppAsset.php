<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '/public';
    public $baseUrl = '/public';

    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap',

        'vendor/font-awesome/css/fontawesome-all.min.css',
        'css/font-electro.css',

        'vendor/animate.css/animate.min.css',
        'vendor/hs-megamenu/src/hs.megamenu.css',
        'vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
        'vendor/fancybox/jquery.fancybox.css',
        'vendor/slick-carousel/slick/slick.css',
        'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
        'css/theme.css',
        'css/style.css',
    ];

    public $js = [
//        'vendor/jquery/dist/jquery.min.js',
        'vendor/jquery-migrate/dist/jquery-migrate.min.js',
        'vendor/popper.js/dist/umd/popper.min.js',
        'vendor/bootstrap/bootstrap.min.js',

        'vendor/appear.js',
        'vendor/jquery.countdown.min.js',
        'vendor/hs-megamenu/src/hs.megamenu.js',
        'vendor/svg-injector/dist/svg-injector.min.js',
        'vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        'vendor/jquery-validation/dist/jquery.validate.min.js',
        'vendor/fancybox/jquery.fancybox.min.js',
        'vendor/typed.js/lib/typed.min.js',
        'vendor/slick-carousel/slick/slick.js',
        'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',

        'js/hs.core.js',
        'js/components/hs.countdown.js',
        'js/components/hs.header.js',
        'js/components/hs.hamburgers.js',
        'js/components/hs.unfold.js',
        'js/components/hs.focus-state.js',
        'js/components/hs.malihu-scrollbar.js',
        'js/components/hs.validation.js',
        'js/components/hs.fancybox.js',
        'js/components/hs.onscroll-animation.js',
        'js/components/hs.slick-carousel.js',
        'js/components/hs.show-animation.js',
        'js/components/hs.svg-injector.js',
        'js/components/hs.go-to.js',
        'js/components/hs.selectpicker.js',
        'js/theme-custom.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
