<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\shops\Shops */

$this->title = Yii::t('app', 'Create Shops');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
