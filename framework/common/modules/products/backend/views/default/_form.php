<?php

use common\models\categories\Category;
use common\models\shops\Shops;
use common\modules\eav\backend\admin\widgets\Fields;
use common\modules\eav\traits\EavTrait;
use common\traits\HelperTrait;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */
/* @var $form yii\widgets\ActiveForm */

echo HelperTrait::errorsAlert($errors);
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            <?= $this->title ?>
                        </h4>
                    </div>
                    <div class="table-responsives">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#text" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Описание</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#specifications" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Характеристики</span>
                                </a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div class="tab-pane p-3 active" id="text" role="tabpanel">
                                <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                                    'editorOptions' => [
                                        'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                        'inline' => false, //по умолчанию false
                                    ],
                                ]); ?>
                            </div>

                            <div class="tab-pane p-3" id="specifications" role="tabpanel">
                                <?= $form->field($model, 'specifications')->widget(CKEditor::className(),[
                                    'editorOptions' => [
                                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                        'inline' => false, //по умолчанию false
                                    ],
                                ]); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Картинки
                        </h4>
                    </div>
                    <div class="body">

                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                                    'options' => [
                                        'accept' => 'image/*'
                                    ],
                                    'pluginOptions' => [
                                        'initialPreview' => !$model->isNewRecord && is_file('..'.UPLOADS . "/{$model->img}") ? UPLOADS . "/{$model->img}" : '',
                                        'initialPreviewAsData' => true,
                                        'showRemove'    => false,
                                        'showUpload'    => false,
                                        'showCaption'   => false,
                                        'browseLabel'   => 'Выбрать картинку',
                                        'removeLabel'   => '',
                                        'mainClass'     => 'input-group-lg',
                                        'browseClass'   => 'btn btn-success btn-block',
                                    ]
                                ])?>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12">
                                <div class="miniatures">
                                    <?= $form->field($model, 'images[]')->widget(\kartik\widgets\FileInput::class, [
                                        'options' => [
                                            'multiple'  => true,
                                            'accept'    => 'image/*'
                                        ],
                                        'pluginOptions' => [
                                            'initialPreview' => !$model->isNewRecord ? HelperTrait::productMiniatures($model->productImages) : [],
                                            'initialPreviewAsData' => true,

                                            'initialPreviewConfig' => [ ],
                                            'browseLabel'   =>  'Выбрать миниатюрки',
                                            'showCaption'   => false,
                                            'maxFileCount'  => 5,
                                            'showRemove'    => false,
                                            'showUpload'    => false,
                                            'removeLabel'   => '',
                                            'mainClass'     => 'input-group-lg',
                                            'browseClass'   => 'btn btn-success btn-block',
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">

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

                        <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                            'data' => Category::getShopsTree(Shops::categoryShop($_GET['shop_id'])),
                            'options' => ['placeholder' => 'Категория товара ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

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

                        <?= $form->field($model, 'eav_ids')->widget(Select2::classname(), [
                            'data'    => EavTrait::eavToProduct(),
                            'options' => [
                                'placeholder' => 'Добавить атрибут',
                                'multiple' => true,
                                'autocomplete' => 'off'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])?>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            Цена
                        </h4>
                    </div>

                    <div class="body">

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'discount')->textInput(['placeholder' => '%']) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'pre_order_price')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'is_installment')->checkbox() ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title mb-4">
                            SEO
                        </h4>
                    </div>
                    <div class="body">

                        <?= $form->field($model, 'meta_d')->textarea(['rows' => 5]) ?>

                        <?= $form->field($model, 'meta_k')->textarea(['rows' => 5]) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>



<?php ActiveForm::end(); ?>
