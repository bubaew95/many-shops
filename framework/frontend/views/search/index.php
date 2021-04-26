<?php
use common\traits\HelperTrait;
use yii\helpers\Html;
use yii\widgets\LinkPager;
$type = $searchForm->type == 'vacancy' ? 'вакансий' : 'резюме';
$this->title = "Поиск {$type}";

$get = Yii::$app->request->get();
?>

<section class="items">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
             <?= $this->title ?>
        </h1>

        <div class="row">


            <div class="col-md-4">
                <div class="form-search">
<!--                    <h5 class="text-center">Форма поиска</h5>-->
                    <?= $this->render(isset($get['serach-advanced']) ? "_advanced_search_form" : '_base_search_form', ['model' => $searchForm])?>
                </div>
            </div>
            <div class="col-md-8">
                <?php if($model) : ?>
                    <?= \frontend\widgets\ItemsWidget::widget([
                        'model'     => $model,
                        'url'       => "{$searchForm->type}/view",
                        'isVacancy' => $searchForm->type == 'vacancy' ? true : false,
                        'classes'   => 'col-lg-6 col-md-6 col-sm-12'
                    ]) ?>

                    <div class="row py-5">
                        <div class="col-md-12">
                            <?= LinkPager::widget([
                                'pagination' => $pages,
                            ])
                            ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="not-data-search text-center">Поиск не дал результатов</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
