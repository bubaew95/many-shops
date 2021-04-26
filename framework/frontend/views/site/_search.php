<?php
use yii\helpers\Html;
?>
<!-- Search -->
<section class="search">
    <div class="container-fluid d-flex justify-content-center">
        <div class="search-form  d-flex flex-column justify-content-center">

            <?= Html::beginForm(['/search/index'], 'get',  [
                    'class' => 'd-flex flex-row align-items-center'
                ])
            ?>

                <?= Html::dropDownList('type', null, [
                        'vacancy' => 'Вакансии',
                        'resume' => 'Резюме'
                    ], [
                            'class' => 'form-control'
                    ])
                ?>

                <?= Html::dropDownList('region', null, \common\traits\HelperTrait::regions(), [
                        'class' => 'form-control',
                        'prompt' => 'Регион'
                    ])
                ?>

            <div class="input-row">
                <div class="input-colulmn">
                    <?= Html::input('search', 'q', null, [
                            'placeholder' => 'Поиск...',
                        ])
                    ?>
                </div>
                <div class="input-colulmn" id="s-cover">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <?= Html::endForm() ?>

        </div>
    </div>
</section>
