<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\locations\GeoCity */

$this->title = Yii::t('app', 'Create Geo City');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
