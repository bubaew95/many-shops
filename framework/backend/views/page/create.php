<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pages\Pages */

$this->title = Yii::t('app', 'Create Pages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
