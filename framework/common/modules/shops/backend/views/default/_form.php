<?php

use common\traits\HelperTrait;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\shops\Shops */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-9 col-md-7 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            <?= $this->title ?>
                        </h4>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label for=""> Латинское название магазина
                                </label>
                                <?= $form->field($model, 'alias')->textInput(['disabled' => !$model->isNewRecord ? 'disabled' : null ])->label(false) ?>
                                <small for="shops-alias" class="text-danger"> Внимание!!! Введите корректное название магазина, потом поменять не получится</small>
                            </div>
                        </div>
                        <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                            'editorOptions' => [
                                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false, //по умолчанию false
                            ],
                        ]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="body">
                        <div class="form-group float-right">
                            <?= Html::a(Yii::t('app', 'Cancel'), $_SERVER['HTTP_REFERER'], ['class' => 'btn btn-danger']) ?>
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Дополнительное
                        </h4>
                    </div>
                    <div class="body">
                        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                            'options' => [
                                'accept' => 'image/*'
                            ],
                            'pluginOptions' => [
                                'initialPreview'=> !$model->isNewRecord && is_file('..'.UPLOADS . "/{$model->logo}") ? UPLOADS . "/{$model->logo}" : '',
                                'initialPreviewAsData'=>true,
                                'initialPreviewConfig' => [[
                                    'key'     => !$model->isNewRecord ? $model->id : null,
                                    'caption' => !$model->isNewRecord ? $model->logo : '',
                                ]],
                                'deleteUrl'     => Url::toRoute(['/shops/default/image-delete']),

                                'showRemove'    => false,
                                'showUpload'    => false,
                                'showCaption'   => false,
                                'browseLabel'   => 'Выбрать картинку',
                                'removeLabel'   => '',
                                'mainClass'     => 'input-group-lg',
                                'browseClass'   => 'btn btn-success btn-block',
                            ]
                        ])?>

                        <?= $form->field($model, 'category_id')->dropDownList(
                            HelperTrait::getCategoriesLevelOne(),
                            [
                                'prompt' => '-- Выбрать категорию --'
                            ]
                        ) ?>

                        <?= $form->field($model, 'meta_d')->textarea(['rows' => 5]) ?>

                        <?= $form->field($model, 'meta_k')->textarea(['rows' => 5]) ?>

                        <?php
                            if(Yii::$app->user->can(ADMIN_ROLE)) {
                                echo $form->field($model, 'active')->dropDownList(HelperTrait::MODEL_STATUS);
                            } else {
                                echo $form->field($model, 'active')->checkbox([
                                    'checked' => $model->isNewRecord ? 'checked' : null,
                                    'disabled' => !$model->isNewRecord && !in_array($model->active, [0, 1]) ? true : false
                                ]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
