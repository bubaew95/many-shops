<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\shops\Shops */

$this->title = Yii::t('app', 'Update Shops: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shops-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
