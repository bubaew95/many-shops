<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сменить пароль';
?>

<section class="page">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>
        <div class="page-form p-5">

            <div class="col-md-6 offset-md-3">
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password')
                        ->passwordInput(['autofocus' => true, 'placeholder' => 'Пароль'])
                    ?>
                    <?= $form->field($model, 'repassword')
                        ->passwordInput(['placeholder' => 'Подтвердить пароль'])
                    ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>