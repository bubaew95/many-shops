<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\adv\Resume */

$this->title = 'Редактирование вакансии';
?>
<div class="registration-form">

    <?= $this->render('../../vacancy/_form', [
        'model' => $model,
    ]) ?>

</div>
