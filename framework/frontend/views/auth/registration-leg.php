<?php
use kartik\form\ActiveForm;
$this->title = 'Регистрация юр.лица';
?>

<!-- legal entity -->
<section class="legal-entity">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>
        <div class="registration-form p-5">
            <?= \common\widgets\Alert::widget(); ?>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'form_id',
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'org_name')
                            ->textInput(['placeholder' => 'Название организации'])
                            ?>

                        <?= $form->field($model, 'inn')
                            ->textInput(['placeholder' => 'ИНН'])
                            ?>

                        <?= $form->field($model, 'phone')
                            ->textInput(['placeholder' => '+7 (XXX) XXX-XX-XX', 'class' => 'phone'])
                            ?>

                        <?= $form->field($model, 'email')
                            ->textInput(['placeholder' => 'Электронная почта'])
                            ?>

                        <?= $form->field($model, 'password')
                            ->passwordInput(['placeholder' => 'Пароль', 'class' => 'password'])
                            ?>

                        <?= $form->field($model, 'repassword')
                            ->passwordInput(['placeholder' => 'Подтвердить пароль', 'class' => 'repassword'])
                            ?>

                    </div>

                    <div class="col-md-6">
                        <div class="reg-img text-center">
                            <label class="label">
                                <div class="rounded-circle img-fluid reg-image" style="background-image: url('/images/user-default.png')"></div>

                                <?= $form->field($model, 'image')
                                    ->fileInput([
                                        'multiple' => true,
                                        'accept' => 'image/*',
                                        'style' => 'display: none',
                                        'class' => 'reg-user-image'
                                    ])
                                    ?>

                                <span>Загрузить изображение</span>
                            </label>
                        </div>

                        <?= $form->field($model, 'is_allow')->checkbox()
                            ->label('Я даю <a href="'.\yii\helpers\Url::to(['page/index', 'alias' => 'oferta']).'" target="_blank">согласие на обработку персональных данных.</a>')
                        ?>

                        <div class="text-center">
                            <button type="submit" class="site-btn btn btn-primary py-2 px-5 my-5">Зарегистрироваться</button>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<!-- End legal entity -->

<?php
$js = <<<JS
    $(function(){
        $("#registrationlegform-inn").mask("9999-99999-9");
    });
JS;
$this->registerJs($js, \yii\web\View::POS_END)
?>