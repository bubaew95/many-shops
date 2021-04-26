<?php
use yii\widgets\ActiveForm;
use common\traits\HelperTrait;
?>

<!-- Search -->
<section class="search">
    <div class="container-fluid d-flex justify-content-center">
        <div class="search-form  d-flex flex-column justify-content-center">

            <?php  $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['search/index'],
                'options' => [
                    'class' => 'd-flex flex-row align-items-center'
                ],
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
            ]); ?>

                <?= $form->field($model, 'type')
                    ->dropDownList([
                        'vacancy'   => 'Вакансии',
                        'resume'    => 'Резюме'
                    ])->label(false)
                ?>

                <?= $form->field($model, 'region')
                    ->dropDownList(HelperTrait::regions(), [
                        'prompt' => 'Регион'
                    ])
                    ->label(false)
                ?>

                <div class="input-row">
                    <div class="input-colulmn">
                        <?= $form->field($model, 'q', [
                                'template' => '{input}{error}'
                        ])
                            ->textInput(['placeholder' => 'Например: Самосвал, Экскаватор...'])
                            ->label(false)
                        ?>
                    </div>
                    <div class="input-colulmn" id="s-cover">
                        <button type="submit" name="serach-base" value="true">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="advanced-search-btn">
                    <button type="submit" class="btn btn-primary site-btn" name="serach-advanced" value="true">
                        Расширенный поиск
                    </button>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<!-- End Search -->