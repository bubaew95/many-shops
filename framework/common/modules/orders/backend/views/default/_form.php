<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\orders\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title mb-4">
                <?= $this->title ?>
            </h4>
        </div>
        <div class="table-responsives">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
