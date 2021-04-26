<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
AppAsset::register($this);

$controller = Yii::$app->controller;
$settings = Yii::$app->settings;

if($settings->has('Site.countersHeader')) {
    Yii::$app->view->injectToHead = $settings->get('Site.countersHeader');
}

if($settings->has('Site.countersFooter')) {
    Yii::$app->view->injectToBodyEnd = $settings->get('Site.countersFooter');
}

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to(['/favicon.ico'])]);

$params = Yii::$app->params;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


    <?php if(!$params['isMobile']) : ?>
        <?= \frontend\widgets\header\HeaderWidget::widget()?>
    <?php endif ?>

    <?= $this->render('_breadcrumb') ?>

    <?= $content ?>

    <?php if(!$params['isMobile']) : ?>
        <?= $this->render('_footer') ?>
    <?php endif ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
