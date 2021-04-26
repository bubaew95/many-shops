<?php

use common\traits\HelperTrait;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
?>

<div class="search-block registration-form">
    <?php  $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['search/index'],
    ]); ?>
        <div class="row">
            <div class="col-md-12">

                <?= $form->field($model, 'type')->dropDownList([
                        'vacancy'   => 'Вакансии',
                        'resume'    => 'Резюме'
                    ])
                ?>

                <?= $form->field($model, 'region')
                    ->dropDownList(HelperTrait::regions(), [
                        'class' => 'region',
                        'prompt' => 'Регион'
                    ])
                ?>

                <div class="spinner-block">
                    <?= $form->field($model, 'city')->dropDownList(
                        !empty($model->region) ? HelperTrait::cities($model->region) : [],
                        [
                            'prompt'=>'Город',
                            'class' => 'city',
                        ])
                    ?>
                    <div class="spinner-border text-warning city-spinner" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <?= $form->field($model, 'driver_licence_id')->widget(Select2::className(), [
                    'data' => HelperTrait::categoryDL(),
                    'options' => [
                        'placeholder' => 'Категория ВУ',
                        'multiple' => true
                    ],
                ])
                ?>

                <?= $form->field($model, 'categoryTr')->dropDownList(HelperTrait::categoryTR(), [
                    'prompt' => 'Категория ТС',
                    'class' => 'selectTrCat',
                ])
                ?>

                <div class="spinner-block">
                    <?= $form->field($model, 'transport_id')
                        ->widget(Select2::className(), [
                            'data' => $model->categoryTr ? HelperTrait::nameTR($model->categoryTr) : [],
                            'options' => [
                                'placeholder' => 'Название ТС',
                                'multiple' => true,
                                'class' => 'preferred_tr'
                            ],
                        ])
                    ?>
                    <div class="spinner-border text-warning transport-spinner" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <?= $form->field($model, 'work_schedule_id')
                    ->widget(Select2::className(), [
                        'data' => HelperTrait::workSchedule(),
                        'options' => [
                            'placeholder' => 'График работы',
                            'multiple' => true,
                        ],
                    ])
                ?>

            </div>
        </div>

        <div class="form-check mt-4" style="column-count: 2">
            <?= $form->field($model, 'opport_id')->checkboxList(HelperTrait::opportList(), [
                'item' => function($index, $label, $name, $checked, $value) {
                    $checked = $checked ? 'checked' : null;
                    return "<div class='form-group highlight-addon field-resume-opport_id'><input type='checkbox' id='opport_id-{$index}' {$checked} name='{$name}' value='{$value}'><label class='control-label-is' for='opport_id-{$index}'>{$label}</label></div>";
                }
            ])->label(false)?>
        </div>

        <input type="hidden" name="serach-advanced" value="true">

        <div class="text-center">
            <button type="submit" class="site-btn btn btn-primary py-2 px-5 my-5">
                <i class="fas fa-search"></i> &nbsp;
                Поиск
            </button>
        </div>

    <?php ActiveForm::end(); ?>

</div>
