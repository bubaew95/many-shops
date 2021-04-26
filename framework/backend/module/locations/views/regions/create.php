<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\locations\GeoRegions */

$this->title = Yii::t('app', 'Create Geo Regions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-regions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
