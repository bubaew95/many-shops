<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\menu\Menu */
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

            <?php $form = ActiveForm::begin(['id' => 'checkForm']); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'page_id')
                    ->dropDownList(\common\traits\HelperTrait::pagesList(), [
                        'prompt' => 'Выберите страницу'
                    ])
                ?>

                <?= $form->field($model, 'link')
                    ->textInput(['maxlength' => true])
                ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<?php
if(!$model->isNewRecord && $model->page_id) {
$js = <<<JS
    $('#menu-link').parent().hide();
JS;
$this->registerJs($js, \yii\web\View::POS_END);
}
?>
