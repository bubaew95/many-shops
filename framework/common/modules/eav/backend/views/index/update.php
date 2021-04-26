<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\eav\models\EavAttribute */

$this->title = 'Update Eav Attribute: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Eav Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eav-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
