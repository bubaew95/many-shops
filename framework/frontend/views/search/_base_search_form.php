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

        <?= $form->field($model, 'q')
            ->textInput(['placeholder' => 'Поиск по ключевым словам'])
        ?>

        <div class="text-center">
            <button type="submit" class="site-btn btn btn-primary py-2 px-5 my-5">
                <i class="fas fa-search"></i> &nbsp;
                Поиск
            </button>
            <button type="submit" class="btn btn-dark site-btn py-2 my-5" name="serach-advanced" value="true">
                Расширенный поиск
            </button>
        </div>

    <?php ActiveForm::end(); ?>



</div>
