<?php

use common\modules\shops\frontend\widgets\ItemsWidget;
use common\traits\HelperTrait;
use common\traits\OrderTrait;
use yii\helpers\Html;
$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => $model->shop->title, 'url' => [ '/shops/info/index', 'alias' => $model->shop->alias ]];
$this->params['breadcrumbs'][] = ['label' => $model->category->title, 'url' => [ '/shops/info/index', 'alias' => $model->shop->alias ]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['headerSettings']['logo'] = UPLOADS . "/{$model->shop->logo}";
?>

<div class="container">
    <!-- Single Product Body -->
    <div class="mb-14">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-5 mb-4 mb-md-0">
                <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                     data-infinite="true"
                     data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                     data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                     data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                     data-nav-for="#sliderSyncingThumb">
                    <div class="js-slide">
                        <?= Html::img(UPLOADS . "/{$model->img}", ['class' => 'img-fluid', 'alt' => $this->title ]) ?>
                    </div>

                    <?php if($model->productImages) : ?>
                        <?php foreach($model->productImages as $key => $image) : ?>
                            <div class="js-slide">
                                <?= Html::img(UPLOADS . "/{$image->image}", ['class' => 'img-fluid', 'alt' => $this->title ]) ?>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>

                </div>

                <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                     data-infinite="true"
                     data-slides-show="6"
                     data-is-thumbs="true"
                     data-nav-for="#sliderSyncingNav">

                    <div class="js-slide" style="cursor: pointer;">
                        <?= Html::img(UPLOADS . "/{$model->img}", ['class' => 'img-fluid', 'alt' => $this->title ]) ?>
                    </div>

                    <?php if($model->productImages) : ?>
                        <?php foreach($model->productImages as $key => $image) : ?>
                            <div class="js-slide" style="cursor: pointer;">
                                <?= Html::img(UPLOADS . "/{$image->image}", ['class' => 'img-fluid', 'alt' => $this->title ]) ?>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                <div class="mb-2">
                    <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">Headphones</a>
                    <h2 class="font-size-25 text-lh-1dot2">
                        <?= $this->title ?>
                    </h2>
                    <div class="mb-2">
                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                            <div class="text-warning mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                            <span class="text-secondary font-size-13">(3 customer reviews)</span>
                        </a>
                    </div>

                    <?= Html::a(
                        Html::img(UPLOADS . "/{$model->shop->logo}", ['class' => 'img-fluid', 'alt' => $model->shop->title ]),
                        ['/shops/info/index', 'alias' => $model->shop->alias],
                        ['class' => 'd-inline-block max-width-150 ml-n2 mb-2']
                    )?>

                    <p>
                        <?= $model->meta_d ?>
                        <br>
                        <a href="#description">
                            Полное описание...
                        </a>
                    </p>
                    <p><strong>Артикул</strong>: <?= "{$model->shop->alias}_{$model->id}" ?></p>
                </div>
            </div>

            <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                <div class="mb-2">
                    <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                        <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">
                            В складе: <span class="text-green font-weight-bold"> 23 шт. </span>
                        </div>
                        <div class="mb-3">
                            <div class="font-size-36">
                                <?php if($model->discount) : ?>
                                    <div class="d-flex align-items-center position-relative">
                                        <ins class="text-red text-decoration-none">
                                            <?= OrderTrait::price($model->price, $model->discount) . RUB ?>
                                        </ins>
                                        <del class="font-size-20 tex-gray-6 position-absolute bottom-100">
                                            <?= $model->price . RUB ?>
                                        </del>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php else : ?>
                                    <?= $model->price . RUB ?>
                                <?php endif ?>
                            </div>
                        </div>

                        <form action="<?= \yii\helpers\Url::to(['/shops/catalog/add'])?>" method="get">
                            <div class="mt-5 mb-3">
                                <h6 class="font-size-14">Кол-во</h6>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-1 w-md-60 height-35 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </div>

                            <div class="mb-3">
                                <?= \common\modules\eav\traits\EavTrait::getEav($model) ?>
                            </div>

                            <div class="mb-2 pb-0dot5">
                                <?= Html::a(
                                    '<i class="ec ec-add-to-cart mr-2 font-size-20"></i> Добавить в корзину',
                                    ['/shops/cart/addtocart', 'id' => $model->id],
                                    ['class' => 'btn btn-block btn-primary-dark']
                                ) ?>
                            </div>

                            <div class="mb-3">
                                <?= Html::a(
                                    'Купить сейчас',
                                    ['/shops/cart/oneclick', 'id' => $model->id],
                                    ['class' => 'btn btn-block btn-dark', 'id' => 'one-click']
                                ) ?>
                            </div>

                        </form>

                        <div class="flex-content-center flex-wrap">
                            <?= Html::a(
                                '<i class="ec ec-favorites mr-1 font-size-15"></i> Сравнить',
                                [],
                                ['class' => 'text-gray-6 font-size-13 mr-2']
                            ) ?>
                            <?= Html::a(
                                '<i class="ec ec-compare mr-1 font-size-15"></i> В избранное',
                                [],
                                ['class' => 'text-gray-6 font-size-13 ml-2']
                            ) ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Product Body -->
    <!-- Single Product Tab -->
    <div class="mb-8">
        <div class="position-relative position-md-static px-md-6">
            <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-lg-down-bottom-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                <!--li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#recomendation" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">
                        Рекомендуемое
                    </a>
                </li-->
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link active"  id="Jpills-two-example1-tab" data-toggle="pill" href="#text" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">
                        Описание
                    </a>
                </li>
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#description" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">
                        Характеристики
                    </a>
                </li>
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#reviews" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">
                        Отзывы
                    </a>
                </li>
            </ul>
        </div>
        <!-- Tab Content -->

        <div class="p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
            <div class="tab-content" id="Jpills-tabContent">
                <!--div class="tab-pane fade active show" id="recomendation" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                    <div class="row no-gutters">
                        <div class="col mb-6 mb-md-0">
                            <ul class="row list-unstyled products-group no-gutters border-bottom border-md-bottom-0">
                                <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down border-0">
                                    <div class="product-item__outer h-100">
                                        <div class="remove-prodcut-hover product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                <div class="mb-2">
                                                    <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="/public/img/212X200/img1.jpg" alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1 d-none d-md-block">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">$685,00</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                <input class="form-check-input" type="checkbox" value="" id="inlineCheckbox1" checked disabled>
                                <label class="form-check-label mb-1" for="inlineCheckbox1">
                                    <strong>This product: </strong> Ultra Wireless S50 Headphones S50 with Bluetooth - <span class="text-red font-size-16">$35.00</span>
                                </label>
                            </div>
                            <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                <label class="form-check-label mb-1 text-blue" for="inlineCheckbox2">
                                    <span class="text-decoration-on cursor-pointer-on">Universal Headphones Case in Black</span> - <span class="text-red font-size-16">$159.00</span>
                                </label>
                            </div>
                            <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2" checked>
                                <label class="form-check-label mb-1 text-blue" for="inlineCheckbox3">
                                    <span class="text-decoration-on cursor-pointer-on">Headphones USB Wires</span> - <span class="text-red font-size-16">$50.00</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="mr-xl-15">
                                <div class="mb-3">
                                    <div class="text-red font-size-26 text-lh-1dot2">$244.00</div>
                                    <div class="text-gray-6">for 3 item(s)</div>
                                </div>
                                <a href="#" class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">Add all to cart</a>
                            </div>
                        </div>
                    </div>
                </div-->

                <div class="tab-pane fade active show" id="text" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                    <?= $model->text ?>
                </div>

                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                    <?= $model->specifications ?>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                    <div class="row mb-8">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h3 class="font-size-18 mb-6">Based on 3 reviews</h3>
                                <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">4.3</h2>
                                <div class="text-lh-1">overall</div>
                            </div>

                            <!-- Ratings -->
                            <ul class="list-unstyled">
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">205</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 53%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">55</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">23</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-muted">0</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                <small class="fas fa-star"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-auto mb-2 mb-md-0">
                                            <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <span class="text-gray-90">4</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Ratings -->
                        </div>
                        <div class="col-md-6">
                            <h3 class="font-size-18 mb-5">Add a review</h3>
                            <!-- Form -->
                            <form class="js-validate">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="rating" class="form-label mb-0">Your Review</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <a href="#" class="d-block">
                                            <div class="text-warning text-ls-n2 font-size-16">
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                                <small class="far fa-star text-muted"></small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="descriptionTextarea" class="form-label">Your Review</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                                    <textarea class="form-control" rows="3" id="descriptionTextarea"
                                                              data-msg="Please enter your message."
                                                              data-error-class="u-has-error"
                                                              data-success-class="u-has-success"></textarea>
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required
                                               data-msg="Please enter your name."
                                               data-error-class="u-has-error"
                                               data-success-class="u-has-success">
                                    </div>
                                </div>
                                <div class="js-form-message form-group mb-3 row">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-label="alexhecker@pixeel.com" required
                                               data-msg="Please enter a valid email address."
                                               data-error-class="u-has-error"
                                               data-success-class="u-has-success">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-md-4 offset-lg-3 col-auto">
                                        <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- Review -->
                    <div class="border-bottom border-color-1 pb-4 mb-4">
                        <!-- Review Rating -->
                        <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="far fa-star text-muted"></small>
                                <small class="far fa-star text-muted"></small>
                            </div>
                        </div>
                        <!-- End Review Rating -->

                        <p class="text-gray-90">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>

                        <!-- Reviewer -->
                        <div class="mb-2">
                            <strong>John Doe</strong>
                            <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                        </div>
                        <!-- End Reviewer -->
                    </div>
                    <!-- End Review -->
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Single Product Tab -->
</div>


<div class="container">

    <!-- Related products -->
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
            <h3 class="section-title mb-0 pb-2 font-size-22">Вы смотрели</h3>
        </div>
        <ul class="row list-unstyled products-group no-gutters">
            <?= ItemsWidget::widget([
                'shopName'  => (string) $model->shop->alias,
                'template'  => 'items-home-grid',
                'classPrI'  => 'col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item',
                'classPrIO' => 'product-item__outer h-100',
                'classPrII' => 'product-item__inner px-xl-4 p-3',
                'classPrIB' => 'product-item__body pb-xl-2',
                'classImg'  => 'd-block text-center',
                'classLast' => ' remove-divider-md-lg',
                'limit'     => 6,
                'where'     => ['in', 'products.id', (array) $_SESSION['viewedItems']],
            ]) ?>
            <div class="clearfix"></div>
        </ul>
    </div>
    <!-- End Related products -->

    <!-- Brand Carousel -->
    <div class="mb-8">
        <div class="py-2 border-top border-bottom">
            <div class="js-slick-carousel u-slick my-1"
                 data-slides-show="5"
                 data-slides-scroll="1"
                 data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                 data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                 data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                 data-responsive='[{
                                "breakpoint": 992,
                                "settings": {
                                    "slidesToShow": 2
                                }
                            }, {
                                "breakpoint": 768,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }, {
                                "breakpoint": 554,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }]'>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img1.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img2.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img3.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img4.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img5.png" alt="Image Description">
                    </a>
                </div>
                <div class="js-slide">
                    <a href="#" class="link-hover__brand">
                        <img class="img-fluid m-auto max-height-50" src="/public/img/200X60/img6.png" alt="Image Description">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Brand Carousel -->
</div>
