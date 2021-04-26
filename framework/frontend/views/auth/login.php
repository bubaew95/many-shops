<?php

use kartik\form\ActiveForm;
use yii\helpers\Url;

$this->title = 'Авторизация';
?>
<!-- Login -->
<section class="login">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>
        <div class="registration-form p-5">

            <?= \common\widgets\Alert::widget(); ?>

            <?php $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
                <div class="col-lg-6 offset-lg-2 col-md-8 offset-lg-3 col-sm-12 offset-sm-2">
                    <?= $form->field($model, 'phone')
                        ->textInput([
                            'placeholder' => 'Номер телефона',
                            'type' => 'tel',
                            'class' => 'phone'
                        ])->label(false)
                    ?>

                    <?= $form->field($model, 'password')
                        ->passwordInput(['placeholder' => 'Пароль'])
                        ->label(false)
                    ?>

                    <div class="form-check mt-4">
                        <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => '<div class="form-group">{input}<label class="control-label" for="loginform-rememberme">Запомнить пароль</label></div>'
                            ])->label(false);
                        ?>

                        <div class="respore-pass">
                            <a href="<?= Url::to(['auth/request-password-reset'])?>">
                                Забыли пароль?
                            </a>
                        </div>
                    </div>

                    <div class="login-btns my-5">
                        <button type="submit" class="btn btn-dark btn-auth site-btn">
                            Войти
                        </button>

                        <a href="<?= Url::to(['auth/personal-type'])?>" class="btn btn-primary site-btn btn-reg">
                            Зарегистрироваться
                        </a>
                    </div>

                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<!-- End Login -->
