<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\adv\Resume */

$this->title = 'Редактирование резюме';
$this->params['breadcrumbs'][] = ['label' => 'Resumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registration-form">

    <?= $this->render('../../resume/_form', [
        'model' => $model,
    ]) ?>

</div>
