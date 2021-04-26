<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\geo\GeoCity */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(['id' => 'checkForm']); ?>
<div class="card ">
    <div class="card-header header-elements-inline d-flex justify-content-between">
        <h5 class="card-title"><?=  $this->title?></h5>
        <div class="header-elements">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">

        </p>
    </div>
    <div class="card-body">
        <div class="geo-city-form">

            <?= $form->field($model, 'region_id')->dropDownList(
                \common\traits\HelperTrait::regions(),
                ['prompt' => 'Выберите регион']
            )?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

