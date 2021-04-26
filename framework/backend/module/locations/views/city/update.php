<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\locations\GeoCity */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="geo-city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
