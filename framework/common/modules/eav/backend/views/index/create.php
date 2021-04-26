<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\eav\models\EavAttribute */

$this->title = 'Create Eav Attribute';
$this->params['breadcrumbs'][] = ['label' => 'Eav Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
