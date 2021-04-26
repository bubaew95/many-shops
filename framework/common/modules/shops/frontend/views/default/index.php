<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="bg-gray-13 bg-md-transparent">
    <div class="container">
        <!-- breadcrumb -->
        <div class="my-md-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Shop</li>
                </ol>
            </nav>
        </div>
        <!-- End breadcrumb -->
    </div>
</div>


<div class="container">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Магазины</h3>
        </div>

        <ul class="row list-unstyled products-group no-gutters mb-6">

            <?php foreach($model as $i => $item) : ?>
                <li class="col-6 col-md-3 product-item <?= (1 + $i) % 4 === 0 ? 'remove-divider' : ''?>">
                    <div class="product-item__outer h-100 w-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <a href="<?= Url::to([ '/shops/info/index', 'alias' => $item->alias ])?>" class="font-size-15 text-gray-90">

                                    <div class="mb-5">
                                        <?= Html::img(THUMBS . "/{$item->logo}", ['class' => 'img-fluid', 'title' => $item->title]) ?>
                                    </div>
                                    <h5 class="text-center mb-1 product-item__title">
                                        <?= $item->title ?>
                                    </h5>

                                </a>

                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>

        </ul>


    </div>

</div>