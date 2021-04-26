<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\categories\Category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
