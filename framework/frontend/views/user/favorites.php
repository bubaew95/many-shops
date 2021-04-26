<?php
use yii\helpers\Url;
$this->title = 'Избранное';
?>

<section class="user-pa">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>

        <div class="row">
            <div class="col-md-3">
                <?= $this->render('_menu') ?>
            </div>
            <div class="col-md-9 personal-area">

                <?php if(!$modelResume && !$modelVakancy) : ?>
                    <div class="text-center">
                        Вы ничего не добавили в избранное
                    </div>
                <?php endif ?>

                <?php if($modelResume) : ?>
                    <div class="resume ">
                        <h5 class="title d-flex align-items-center">
                            Резюме
                        </h5>

                        <?= \frontend\widgets\ItemsWidget::widget([
                            'model' => $modelResume,
                            'url' => 'resume/view',
                            'classes'   => 'col-lg-6 col-md-6 col-sm-12'
                        ]) ?>

                    </div>
                <?php endif ?>

                <?php if($modelVakancy) : ?>
                    <div class="vakancy">
                        <h5 class="title d-flex align-items-center">
                            Вакансии
                        </h5>

                        <?= \frontend\widgets\ItemsWidget::widget([
                            'model' => $modelVakancy,
                            'url' => 'vacancy/view',
                            'isVacancy' => true,
                            'classes'   => 'col-lg-6 col-md-6 col-sm-12'
                        ]) ?>

                    </div>
                <?php endif ?>

            </div>
        </div>

    </div>
</section>