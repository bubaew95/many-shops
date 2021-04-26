<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['class' => 'login-form']]); ?>
<div class="card mb-0">
    <div class="card-body">
        <div class="text-center mb-3">
<!--            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>-->
            <img src="/admin/images/logo.png" width="100"/>
            <h5 class="mb-0">
                <?= Yii::t('app', 'Login to your account')?>
            </h5>
        </div>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Login') . ' <i class="icon-circle-right2 ml-2"></i>', ['class' => 'btn btn-primary btn-block', 'name' => 'user-button']) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
