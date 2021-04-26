<?php

use common\traits\DateTrait;
use common\traits\HelperTrait;
use common\traits\OrderTrait;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
'/admin/js/plugins/media/fancybox.min.js',
    ['depends' => \backend\assets\AppAsset::class]
);
?>
<div class="products-view">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-4">
                                    </h4>
                <div class="btns">
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="table-responsive2">
                <h4 class="mt-0 font-size-16"><?= $this->title ?></h4>

                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" src="<?= THUMBS . "/{$model->img}"?>" alt="Generic placeholder image">
                    </div>
                    <div class="col-md-9">

                        <div class="info">
                            <div>Категория: <span><?= $model->category->title ?></span></div>
                            <div>Цена: <span><?= OrderTrait::viewPrice($model->price, $model->discount) ?></span></div>
                            <div>Скидка: <span><?= $model->discount ?>%</span></div>
                            <div>Видимость:
                                <span>
                                    <?php
                                        $status = HelperTrait::statusesPublish($model->active);
                                        echo $status['title'];
                                    ?>
                                </span>
                            </div>
                            <div>Рассрочка: <span><?= $model->is_installment ? 'Есть' : 'Нет'?></span></div>
                            <div>Предзаказ: <span><?= $model->pre_order_price ? 'Есть' : 'Нет'?></span></div>
                            <?php
                                if($model->pre_order_price) {
                                    echo "<div>Сумма предзаказа: <span>{$model->pre_order_price}₽</span></div>";
                                }
                            ?>


                            <div>Дата добавления: <span><?= DateTrait::convert($model->created_at, 'datetime') ?></span></div>
                            <div>Дата изменения: <span><?= DateTrait::convert($model->updated_at, 'datetime') ?></span></div>

                        </div>
                    </div>
                </div>

                <div class="additionals mt-5">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home1" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Описание</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#images" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Картинки</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#profile1" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Характеристики</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">SEO</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane p-3 active" id="home1" role="tabpanel">
                            <?= $model->text ?>
                        </div>

                        <div class="tab-pane p-3" id="profile1" role="tabpanel">
                            <?= $model->specifications ?>
                        </div>

                        <div class="tab-pane p-3" id="images" role="tabpanel">
                            <div class="row">
                                <?php foreach (HelperTrait::productMiniatures($model->productImages, '') as $productMiniature) : ?>

                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-img">
                                                <a href="<?= UPLOADS . $productMiniature ?>" class="" data-popup="lightbox" rel="group">
                                                    <img src="<?= THUMBS . $productMiniature ?>" alt="" class="card-img img-fluid rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="tab-pane p-3" id="seo" role="tabpanel">
                            <div class="row">
                                <?php if($model->meta_d) : ?>
                                    <div class="col-md-12">
                                        <h6>Краткое описание</h6>
                                        <?= $model->meta_d?>
                                    </div>
                                <?php endif ?>

                                <?php if($model->meta_k) : ?>
                                    <div class="col-md-12">
                                        <h6>Ключевые слова</h6>
                                        <?= $model->meta_k?>
                                    </div>
                                <?php endif ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
