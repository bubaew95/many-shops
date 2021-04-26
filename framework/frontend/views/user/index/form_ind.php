<?php
use kartik\widgets\ActiveForm;
?>
<div class="registration-form personal-area">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'firstname')
                ->textInput(['placeholder' => 'Фамилия'])
            ?>

            <?= $form->field($model, 'name')
                ->textInput(['placeholder' => 'Имя'])
            ?>

            <?= $form->field($model, 'lastname')
                ->textInput(['placeholder' => 'Отчество'])
            ?>

            <?= $form->field($model, 'phone')
                ->textInput(['placeholder' => '+7 (XXX) XXX-XX-XX', 'class' => 'phone'])
            ?>

            <?= $form->field($model, 'email')
                ->textInput(['placeholder' => 'Электронная почта'])
            ?>

            <?= $form->field($model, 'birthday')
                ->textInput(['placeholder' => 'Дата рождения', 'class' => 'birthday'])
            ?>
        </div>

        <div class="col-md-6">
            <div class="reg-img text-center">
                <label class="label">
                    <div class="rounded-circle img-fluid reg-image" style="background-image: url('/<?= $model->image?>')"></div>

                    <?= $form->field($model, 'image')
                        ->fileInput([
                            'multiple' => true,
                            'accept' => 'image/*',
                            'style' => 'display: none',
                            'class' => 'reg-user-image'
                        ])->label(false)
                    ?>

                    <span>Загрузить изображение</span>
                </label>
            </div>

            <?= $form->field($model, 'password')
                ->passwordInput(['placeholder' => 'Пароль', 'class' => 'password'])
            ?>

            <?= $form->field($model, 'repassword')
                ->passwordInput(['placeholder' => 'Подтвердить пароль', 'class' => 'repassword'])
            ?>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="site-btn btn btn-primary py-2 px-5 my-5">
            <i class="fas fa-save"></i> &nbsp;
            Обновить
        </button>
    </div>

    <?php ActiveForm::end(); ?>
</div>