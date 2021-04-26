<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\categories\Category */

$this->title = Yii::t('app', 'Update Category: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categories-update">

    <?php if(!$isShopMenuRename) : ?>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    <?php else: ?>

        <?= $this->render('_rename-form', [
            'model' => $model,
            'modelRename' => $modelRename
        ]) ?>

    <?php endif ?>

</div>
