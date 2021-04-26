<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\pages\Pages */
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

                <div class="row">
                    <div class="col-md-8">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                            'editorOptions' => [
                                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false, //по умолчанию false
                            ],
                        ]); ?>
                        <?= $form->field($model, 'alias')
                            ->textInput([
                                'disabled' => $model->isNewRecord ? false : true,
                                'value' => $model->isNewRecord ? '' : \common\traits\HelperTrait::domain() . "/{$model->alias}"
                            ])
                        ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'keywords')
                            ->textarea(['rows' => 5, 'placeholder' => "Писать через запятую"])
                        ?>

                        <?= $form->field($model, 'descriptions')->textarea(['rows' => 5])?>

                        <?php
                            if(Yii::$app->user->can(ADMIN_ROLE)) {
                                echo $form->field($model, 'active')->dropDownList(
                                        \common\traits\HelperTrait::MODEL_STATUS
                                );
                            } else {
                                echo $form->field($model, 'active')->checkbox([
                                    'checked' => $model->isNewRecord ? 'checked' : null,
                                    'disabled' => !$model->isNewRecord && !in_array($model->active, [0, 1]) ? true : false
                                ]);
                            }
                        ?>

                        <?php if(Yii::$app->user->can(ADMIN_ROLE)) : ?>
                            <?= $form->field($model, 'isRootPage')->checkbox() ?>
                        <?php endif ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
