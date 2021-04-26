<?php

use common\models\categories\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\categories\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title mb-4">
                        <?= $this->title ?>
                    </h4>
                </div>
                <div class="table-responsives">

                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                        <?//= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

                        <div class='form-group field-attribute-parentId'>
                            <?= Html::label('Parent', 'parent', ['class' => 'control-label']);?>
                            <?= Html::dropdownList(
                                'Category[parentId]',
                                $model->parentId,
                                Category::getTree($model->id),
                                ['prompt' => '-- Родительская категория --', 'class' => 'form-control']
                            );?>

                        </div>

                        <?= $form->field($model, 'position')->textInput([
                                'value' => $model->isNewRecord ? 500 : $model->position
                        ]) ?>

                        <?= $form->field($model, 'block')->dropDownList([ 'top' => 'Top', 'sidebar' => 'Sidebar', 'bottom' => 'Bottom', ], ['prompt' => '']) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
