<?php
use common\modules\shops\frontend\widgets\ItemsWidget;
?>

<?= $this->render('_header', compact('model'))?>
<?= $this->render('_slider', compact('model'))?>

<div class="container">

    <?= $this->render('_banners', compact('model'))?>

    <!-- Feature List -->
    <div class="mb-6 row border rounded-lg mx-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
        <!-- Feature List -->
        <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all py-3">
            <div class="u-avatar mr-2">
                <i class="text-primary ec ec-transport font-size-46"></i>
            </div>
            <div class="media-body text-center">
                <span class="d-block font-weight-bold text-dark">Free Delivery</span>
                <div class=" text-secondary">from $50</div>
            </div>
        </div>
        <!-- End Feature List -->

        <!-- Feature List -->
        <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
            <div class="u-avatar mr-2">
                <i class="text-primary ec ec-customers font-size-56"></i>
            </div>
            <div class="media-body text-center">
                <span class="d-block font-weight-bold text-dark">99 % Customer</span>
                <div class=" text-secondary">Feedbacks</div>
            </div>
        </div>
        <!-- End Feature List -->

        <!-- Feature List -->
        <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
            <div class="u-avatar mr-2">
                <i class="text-primary ec ec-returning font-size-46"></i>
            </div>
            <div class="media-body text-center">
                <span class="d-block font-weight-bold text-dark">365 Days</span>
                <div class=" text-secondary">for free return</div>
            </div>
        </div>
        <!-- End Feature List -->

        <!-- Feature List -->
        <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
            <div class="u-avatar mr-2">
                <i class="text-primary ec ec-payment font-size-46"></i>
            </div>
            <div class="media-body text-center">
                <span class="d-block font-weight-bold text-dark">Payment</span>
                <div class=" text-secondary">Secure System</div>
            </div>
        </div>
        <!-- End Feature List -->

        <!-- Feature List -->
        <div class="media col px-6 px-xl-4 px-wd-8 flex-shrink-0 flex-xl-shrink-1 min-width-270-all border-left py-3">
            <div class="u-avatar mr-2">
                <i class="text-primary ec ec-tag font-size-46"></i>
            </div>
            <div class="media-body text-center">
                <span class="d-block font-weight-bold text-dark">Only Best</span>
                <div class=" text-secondary">Brands</div>
            </div>
        </div>
        <!-- End Feature List -->
    </div>
    <!-- End Feature List -->

    <!-- Tab Prodcut Section -->
    <div class="mb-6">
        <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">
                Последние поступления
            </h3>
        </dv>

        <!-- Tab Content -->
        <ul class="row list-unstyled products-group no-gutters mb-0">
            <?= ItemsWidget::widget([
                'template'  => 'items-home-grid',
                'classPrI'  => 'col-md-4 col-lg-2 product-item remove-divider',
                'classPrIO' => 'product-item__outer h-100 w-100',
                'classPrII' => 'product-item__inner px-xl-4 p-3',
                'classPrIB' => 'product-item__body pb-xl-2',
                'classImg'  => 'd-block text-center',
                'limit'     => 12
            ]) ?>
        </ul>
        <!-- End Tab Content -->
    </div>
    <!-- End Tab Prodcut Section -->



</div>

<!-- Television Entertainment -->
<div class="mb-6" style="background-image: url('https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2017/02/HomeV3ProductBackground.jpg');">
    <div class="container">
        <div class="row min-height-564 align-items-center">
            <div class="col-12 col-lg-4 col-xl-5 col-wd-6 d-none d-md-block">
                <img class="img-fluid" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/02/ad-banner-3.png" alt="Image Description">
            </div>
            <div class="col-12 col-lg-8 col-xl-7 col-wd-6 pt-6 pt-md-0">

                <div class=" d-flex border-bottom border-color-1 mr-md-2">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Television Entertainment</h3>
                </div>

                <div class="js-slick-carousel position-static u-slick u-slick--gutters-2 u-slick overflow-hidden u-slick-overflow-visble py-5"
                     data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10 pt-6 pt-md-0"
                     data-arrow-left-classes="fa fa-angle-left right-2"
                     data-arrow-right-classes="fa fa-angle-right right-1"
                     data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

                    <?= ItemsWidget::widget([
                        'template'  => 'items-home-slider',
                        'subTemplate' => 'items-home-list',
                        'divOptions' => 'class="js-slide"',
                        'ulOptions' => 'class="row list-unstyled products-group no-gutters mb-0 overflow-visible"',

                        'classPrI'  => 'col-md-6 product-item product-item__card mb-2 remove-divider pr-md-2 border-bottom-0',
                        'classPrIO' => 'product-item__outer h-100 w-100',
                        'classPrII' => 'product-item__inner p-md-3 row no-gutters bg-white max-width-334',
                        'classPrIB' => 'col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0',
                        'classImg'  => 'max-width-120 d-block',
                        'limit'     => 100,
                        'tabItems'  => 4,
                        'isUl'      => true
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Television Entertainment -->


<div class="container">
    <!-- Laptops & Computers -->
    <div class="mb-6 position-relative">
        <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Laptops & Computers</h3>
        </dv>
        <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
             data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
             data-arrow-left-classes="fa fa-angle-left right-1"
             data-arrow-right-classes="fa fa-angle-right right-0"
             data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

            <?= ItemsWidget::widget([
                'template'  => 'items-home-slider',
                'subTemplate' => 'items-home-list',
                'divOptions' => 'class="js-slide"',
                'ulOptions' => 'class="row list-unstyled products-group no-gutters mb-0 overflow-visible"',

                'classPrI'  => 'col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0',
                'classPrIO' => 'product-item__outer h-100 w-100',
                'classPrII' => 'product-item__inner p-md-3 row no-gutters',
                'classImg'  => 'max-width-150 d-block',
                'classPrIB' => 'col col-xl-7 col-wd product-item__body pl-2 pl-lg-3 pl-xl-0 pl-wd-3 mr-wd-1',
                'limit'     => 100,
                'tabItems'  => 6,
                'isUl'      => true
            ]) ?>

        </div>
    </div>
    <!-- End Laptops & Computers -->
    <!-- Trending Products -->
    <div class="mb-8 position-relative">
        <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Trending Products</h3>
        </dv>
        <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
             data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
             data-arrow-left-classes="fa fa-angle-left right-1"
             data-arrow-right-classes="fa fa-angle-right right-0"
             data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

            <?= ItemsWidget::widget([
                'template'  => 'items-home-slider',
                'subTemplate' => 'items-home-list',
                'divOptions' => 'class="js-slide"',
                'ulOptions' => 'class="row list-unstyled products-group no-gutters mb-0 overflow-visible"',

                'classPrI'  => 'col-wd-3 col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0',
                'classPrIO' => 'product-item__outer h-100 w-100',
                'classPrII' => 'product-item__inner p-md-3 row no-gutters',
                'classImg'  => 'max-width-150 d-block',
                'classPrIB' => 'col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1',
                'limit'     => 100,
                'tabItems'  => 4,
                'isUl'      => true
            ]) ?>

        </div>
    </div>
    <!-- End Trending Products -->
</div>
<!-- Products-8-1 -->
<div class="products-group-8-1 space-1 bg-gray-7 mb-6">
    <h2 class="sr-only">Products Grid</h2>
    <div class="container">
        <!-- Nav nav-pills -->
        <div class="position-relative text-center z-index-2 mb-3">
            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                <h3 class="section-title mb-0 pb-2 font-size-22">Bestsellers</h3>

                <ul class="nav nav-pills nav-tab-pill mb-2 pt-3 pt-lg-0 mb-0 border-top border-color-1 border-lg-top-0 align-items-center font-size-15 font-size-15-lg flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble pr-0" id="pills-tab-1" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link rounded-pill active" id="Tpills-one-example1-tab" data-toggle="pill" href="#Tpills-one-example1" role="tab" aria-controls="Tpills-one-example1" aria-selected="true">Top 20</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Nav Pills -->

        <!-- Tab Content -->
        <div class="tab-content" id="Tpills-tabContent">
            <div class="tab-pane fade pt-2 show active" id="Tpills-one-example1" role="tabpanel" aria-labelledby="Tpills-one-example1-tab">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-7 col-wd-8 d-md-flex d-wd-block">
                        <ul class="row list-unstyled products-group no-gutters mb-0">

                            <?= ItemsWidget::widget([
                                'template'  => 'items-home-grid',
                                'classPrI'  => 'col-md-6 col-lg-4 col-wd-3 product-item remove-divider',
                                'classPrIO' => 'product-item__outer h-100 w-100 w-100 prodcut-box-shadow',
                                'classPrII' => 'product-item__inner bg-white p-3',
                                'classImg'  => 'd-block text-center',
                                'classPrIB' => 'product-item__body pb-xl-2',
                                'limit'     => 8,
                                'isUl'      => true
                            ]) ?>

                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-wd-4 products-group-1">
                        <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                            <li class="col product-item remove-divider">
                                <div class="product-item__outer h-100 w-100 w-100 prodcut-box-shadow">
                                    <div class="product-item__inner bg-white p-3">
                                        <div class="product-item__body d-flex flex-column">
                                            <div class="mb-1">
                                                <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Game Consoles</a></div>
                                                <h5 class="mb-0 product-item__title"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Game Console Controller + USB 3.0 Cable</a></h5>
                                            </div>
                                            <div class="mb-1 min-height-8-1">
                                                <a href="#" class="d-block text-center my-4 mt-lg-6 mb-xl-5 mb-lg-0 mt-xl-0 mb-xl-0 mt-wd-6 mb-wd-5"><img class="img-fluid" src="/public/img/564X520/img2.jpg" alt="Image Description"></a>
                                                <!-- Gallery -->
                                                <div class="row mx-gutters-2 mb-3">
                                                    <div class="col-auto">
                                                        <!-- Gallery -->
                                                        <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                           data-src="/public/img/1920X1080/img1.jpg"
                                                           data-fancybox="fancyboxGallery6"
                                                           data-caption="Electro in frames - image #01"
                                                           data-speed="700"
                                                           data-is-infinite="true">
                                                            <img class="img-fluid border" src="/public/img/100X100/img1.jpg" alt="Image Description">

                                                            <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                        </a>
                                                        <!-- End Gallery -->
                                                    </div>

                                                    <div class="col-auto">
                                                        <!-- Gallery -->
                                                        <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                           data-src="/public/img/1920X1080/img2.jpg"
                                                           data-fancybox="fancyboxGallery6"
                                                           data-caption="Electro in frames - image #02"
                                                           data-speed="700"
                                                           data-is-infinite="true">
                                                            <img class="img-fluid border" src="/public/img/100X100/img2.jpg" alt="Image Description">

                                                            <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                        </a>
                                                        <!-- End Gallery -->
                                                    </div>

                                                    <div class="col-auto">
                                                        <!-- Gallery -->
                                                        <a class="js-fancybox max-width-60 u-media-viewer" href="javascript:;"
                                                           data-src="/public/img/1920X1080/img3.jpg"
                                                           data-fancybox="fancyboxGallery6"
                                                           data-caption="Electro in frames - image #03"
                                                           data-speed="700"
                                                           data-is-infinite="true">
                                                            <img class="img-fluid border" src="/public/img/100X100/img3.jpg" alt="Image Description">

                                                            <span class="u-media-viewer__container">
                                                                            <span class="u-media-viewer__icon">
                                                                                <span class="fas fa-plus u-media-viewer__icon-inner"></span>
                                                                            </span>
                                                                        </span>
                                                        </a>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                                <!-- End Gallery -->
                                            </div>
                                            <div class="flex-center-between">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-add-cart__wide btn-primary transition-3d-hover"><i class="ec ec-add-to-cart mr-2"></i> Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Add to Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Tab Content -->
    </div>

    <!-- Content Placeholder -->
    <div class="container space-2 d-none">
        <!-- Nav Pills -->
        <div class="position-relative text-center z-index-2 mb-3">
            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                <h3 class="section-title mb-0 pb-2 font-size-22">Bestsellers</h3>

                <ul class="nav nav-pills nav-tab-pill mb-2 pt-3 pt-lg-0 mb-0 border-top border-color-1 border-lg-top-0 align-items-center font-size-15 font-size-15-lg flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble pr-0" id="pills-tab-2" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link rounded-pill active" id="Gpills-one-example1-tab" data-toggle="pill" href="#Gpills-one-example1" role="tab" aria-controls="Gpills-one-example1" aria-selected="true">Top 20</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link rounded-pill" id="Gpills-two-example1-tab" data-toggle="pill" href="#Gpills-two-example1" role="tab" aria-controls="Gpills-two-example1" aria-selected="false">Smart Phones & Tablets</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link rounded-pill" id="Gpills-three-example1-tab" data-toggle="pill" href="#Gpills-three-example1" role="tab" aria-controls="Gpills-three-example1" aria-selected="false">Laptops &amp; Computers</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link rounded-pill" id="Gpills-four-example1-tab" data-toggle="pill" href="#Gpills-four-example1" role="tab" aria-controls="Gpills-four-example1" aria-selected="false">Video Cameras</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Nav Pills -->

        <!-- Tab Content -->
        <div class="tab-content" id="Gpills-tabContent">
            <div class="tab-pane fade pt-2 show active" id="Gpills-one-example1" role="tabpanel" aria-labelledby="Gpills-one-example1-tab">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-7 col-wd-8 d-md-flex d-wd-block">
                        <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-wd-4 products-group-1">
                        <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                            <li class="col product-item remove-divider">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-450"></div>
                                            </div>
                                            <div class="mb-4">
                                                <!-- Gallery -->
                                                <div class="row mx-gutters-2">
                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                                <!-- End Gallery -->
                                            </div>
                                            <div class="flex-center-between">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade pt-2" id="Gpills-two-example1" role="tabpanel" aria-labelledby="Gpills-two-example1-tab">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-7 col-wd-8 d-md-flex d-wd-block">
                        <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-wd-4 products-group-1">
                        <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                            <li class="col product-item remove-divider">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-450"></div>
                                            </div>
                                            <div class="mb-4">
                                                <!-- Gallery -->
                                                <div class="row mx-gutters-2">
                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                                <!-- End Gallery -->
                                            </div>
                                            <div class="flex-center-between">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade pt-2" id="Gpills-three-example1" role="tabpanel" aria-labelledby="Gpills-three-example1-tab">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-7 col-wd-8 d-md-flex d-wd-block">
                        <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-wd-4 products-group-1">
                        <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                            <li class="col product-item remove-divider">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-450"></div>
                                            </div>
                                            <div class="mb-4">
                                                <!-- Gallery -->
                                                <div class="row mx-gutters-2">
                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                                <!-- End Gallery -->
                                            </div>
                                            <div class="flex-center-between">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade pt-2" id="Gpills-four-example1" role="tabpanel" aria-labelledby="Gpills-four-example1-tab">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-7 col-wd-8 d-md-flex d-wd-block">
                        <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-lg-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6 col-lg-4 col-wd-3 d-md-none d-wd-block">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="pb-xl-2">
                                            <div class="mb-2">
                                                <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-190"></div>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-5 col-wd-4 products-group-1">
                        <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                            <li class="col product-item remove-divider">
                                <div class="h-100 w-100 prodcut-box-shadow">
                                    <div class="bg-white p-3">
                                        <div class="d-flex flex-column">
                                            <div class="mb-1">
                                                <div class="mb-2">
                                                    <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                    <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="bg-gray-1 height-450"></div>
                                            </div>
                                            <div class="mb-4">
                                                <!-- Gallery -->
                                                <div class="row mx-gutters-2">
                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="bg-gray-1 width-60 height-60"></div>
                                                    </div>
                                                    <div class="col"></div>
                                                </div>
                                                <!-- End Gallery -->
                                            </div>
                                            <div class="flex-center-between">
                                                <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Content Placeholder -->
</div>
<!-- End Products-8-1 -->

<div class="container">

    <!-- Recommendation for you -->
    <div class="position-relative">
        <div class="border-bottom border-color-1 mb-2">
            <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">Recommendation for you</h3>
        </div>
        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
             data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
             data-slides-show="7"
             data-slides-scroll="1"
             data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
             data-arrow-left-classes="fa fa-angle-left right-1"
             data-arrow-right-classes="fa fa-angle-right right-0"
             data-responsive='[{
                          "breakpoint": 1400,
                          "settings": {
                            "slidesToShow": 6
                          }
                        }, {
                            "breakpoint": 1200,
                            "settings": {
                              "slidesToShow": 3
                            }
                        }, {
                          "breakpoint": 992,
                          "settings": {
                            "slidesToShow": 3
                          }
                        }, {
                          "breakpoint": 768,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }, {
                          "breakpoint": 554,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }]'>

            <?= ItemsWidget::widget([
                'classPrIO' => 'product-item__outer h-100 w-100',
                'classPrII' => 'product-item__inner px-wd-4 p-2 p-md-3',
                'classImg'  => 'd-block text-center',
                'classPrIB' => 'product-item__body pb-xl-2',
                'limit'     => 12
            ]) ?>

        </div>
    </div>
    <!-- End Recommendation for you -->
    <!-- Banner 2 columns -->

    <div class="mb-8">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <a href="../shop/shop.html">
                    <img class="img-fluid" src="/public/img/690X150/img1.jpg" alt="Image Description">
                </a>
            </div>
            <div class="col-md-6">
                <a href="../shop/shop.html">
                    <img class="img-fluid" src="/public/img/690X150/img2.jpg" alt="Image Description">
                </a>
            </div>
        </div>
    </div>

    <!-- End Banner 2 columns -->
</div>

<!-- Brand Carousel -->
<div class="container mb-8">
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