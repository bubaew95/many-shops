<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/bootstrap.min.css",
        "css/metismenu.min.css",
        "css/icons.css",
        "icons/glyphicon/styles.css",
        "css/style.css",
    ];
    public $js = [
//        "js/jquery.min.js",
        "js/bootstrap.bundle.min.js",
        "js/metisMenu.min.js",
        "js/jquery.slimscroll.js",
        "js/waves.min.js",
        "js/app.js",
        'js/custom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
