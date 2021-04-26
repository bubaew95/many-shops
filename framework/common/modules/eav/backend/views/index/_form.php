<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\eav\models\EavAttribute */
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

                <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'field_type')->textInput(['maxlength' => true, 'value' => $_GET['type']]) ?>

                <?= $form->field($model, 'field_options')->textarea() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
