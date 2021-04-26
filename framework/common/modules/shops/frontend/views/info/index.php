<?php

use common\modules\categories\components\Menu;
use common\modules\categories\components\MenuItems;
use common\modules\shops\frontend\widgets\ItemsWidget;
use common\traits\HelperTrait;

?>

<?//= $this->render('_header', compact('model'))?>
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
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">
                Акции магазина
            </h3>
            <a href="#">
                показать все
            </a>
        </div>

        <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3 "
             data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
             data-arrow-left-classes="fa fa-angle-left right-1"
             data-arrow-right-classes="fa fa-angle-right right-0"
             data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">

            <?= ItemsWidget::widget([
                'template'  => 'items-home-slider',
                'subTemplate' => 'items-home-list',
                'divOptions' => 'class="js-slide"',
                'ulOptions' => 'class="row list-unstyled products-group mx-1 overflow-visible"',

                'classPrI'  => 'col-md-4 col-sm-6 col-6 col-lg-2 product-item remove-divider',
                'classPrIO' => 'product-item__outer h-100 w-100',
                'classPrII' => 'product-item__inner p-md-3 row ',
                'classImg'  => 'max-width-150 d-block',
                'classPrIB' => 'col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1',
                'limit'     => 12,
                'tabItems'  => 6,
                'isUl'      => true
            ]) ?>

        </div>
    </div>
    <!-- End Tab Prodcut Section -->

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
                'classPrI'  => 'col-md-4 col-sm-6 col-6 col-lg-2 product-item remove-divider',
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

<div class="container">
    <!-- Banners -->
    <div class="mb-8">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="banner-img">
                    <a href="../shop/shop.html">
                        <img class="img-fluid" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2018/10/two-banner-1.jpg" alt="Image Description">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-img">
                    <a href="../shop/shop.html">
                        <img class="img-fluid" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2018/10/two-banner-2.jpg" alt="Image Description">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banners -->
</div>

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <div class="container">
        <div class="row mb-8">
            <!-- Cat -->
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->

                    <div class="dropdown-title menu-title">
                        Категории
                    </div>

                    <?= Menu::widget([
                        'items' => MenuItems::selectMenuItems(),
                        'activateParents' => true,
                        'activeCssClass' => "active",
                        'linkTemplate' => [
                            'class' => 'dropdown-toggle dropdown-toggle-collapse',
                            'id' => 'menu-item-shop-{id}',
                            'role' => "button",
//                            'data-toggle' => "collapse",
//                            'aria-expanded' => "false",
//                            'aria-controls' => "menu-item-shop-{id}",
//                            'data-target' => "#menu-item-shop-{id}",
                        ],
                        'options' => [
                            'id'=>"sidebarNav",
                            'class' => 'list-unstyled mb-0 sidebar-navbar view-all',
                        ],
                        'submenuTemplate' => '
                            <div id="menu-subitem-shop-{id}" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">{items}</ul>
                            </div>
                        ',
                        //'subLinkTemplate' => '<a class="dropdown-toggle dropdown-toggle-collapse " href="{url}">{label}</a>'
                    ]) ?>

                    <!-- End List -->
                </div>

                <aside class="mb-8 item-img-container">
                    <a href="../shop/shop.html" class="d-block">
                        <img class="img-fluid" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2018/04/home-v4-banner-1.jpg" alt="Image Description">
                    </a>
                </aside>

                <aside class="mb-8 item-img-container">
                    <a href="../shop/shop.html" class="d-block">
                        <img class="img-fluid" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2019/04/footer-widget-img-01.jpg" alt="Image Description">
                    </a>
                </aside>
            </div>
            <!-- End cat -->

            <!-- Content -->
            <div class="col-xl-9 col-wd-9gdot5">

                <div class="border-bottom border-color-1 mb-2">
                    <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">
                        Продавец рекомендует
                    </h3>
                </div>

                <!-- Tab Content -->
                <ul class="row list-unstyled products-group no-gutters">
                    <?= ItemsWidget::widget([
                        'template'  => 'items-home-grid',
                        'classPrI'  => 'col-6 col-md-3 product-item',
                        'classPrIO' => 'product-item__outer h-100 w-100',
                        'classPrII' => 'product-item__inner px-xl-4 p-3',
                        'classPrIB' => 'product-item__body pb-xl-2',
                        'classImg'  => 'd-block text-center',
                        'limit'     => 12
                    ]) ?>
                </ul>
                <!-- End Tab Content -->

            </div>
            <!-- End content -->
        </div>
        <!-- Brand Carousel -->

    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<div class="container">
    <div class="mb-5">
        <h1 class="text-center">Контакты</h1>
    </div>
    <div class="row mb-10">
        <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
            <div class="mr-xl-6">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Обратная связь</h3>
                </div>
                <p class="max-width-830-xl text-gray-90">Aenean massa diam, viverra vitae luctus sed, gravida eget est. Etiam nec ipsum porttitor, consequat libero eu, dignissim eros. Nulla auctor lacinia enim id mollis. Curabitur luctus interdum eleifend. Ut tempor lorem a turpis fermentum.</p>
                <form class="js-validate" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    First name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="firstName" placeholder="" aria-label="" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    Last name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="lastName" placeholder="" aria-label="" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Input -->
                        </div>

                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    Subject
                                </label>
                                <input type="text" class="form-control" name="Subject" placeholder="" aria-label="" data-msg="Please enter subject." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Input -->
                        </div>
                        <div class="col-md-12">
                            <div class="js-form-message mb-4">
                                <label class="form-label">
                                    Your Message
                                </label>

                                <div class="input-group">
                                    <textarea class="form-control p-5" rows="4" name="text" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary-dark-w px-5">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-xl-6">
            <div class="mb-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2902.757487071662!2d45.690949815715!3d43.31933588197277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4051d3e6cb687125%3A0x8e973c5e4ac5692a!2sGrozny%2C%20Chechnya%2C%20364061!5e0!3m2!1sen!2sru!4v1616172069454!5m2!1sen!2sru" width="100%" height="288" frameborder="0" style="border:0;" allowfullscreen=""></iframe> 
            </div>
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-25">Наш адрес</h3>
            </div>
            <address class="mb-6 text-lh-23">
                121 King Street,
                Melbourne VIC 3000,
                Australia
                <div class="">Support(+800)856 800 604</div>
                <div class="">Email: <a class="text-blue text-decoration-on" href="mailto:contact@yourstore.com">info@electro.com</a></div>
            </address>
            <h5 class="font-size-14 font-weight-bold mb-3">Opening Hours</h5>
            <div class="">Monday to Friday: 9am-9pm</div>
            <div class="mb-6">Saturday to Sunday: 9am-11pm</div>
            <h5 class="font-size-14 font-weight-bold mb-3">Careers</h5>
            <p class="text-gray-90">If you’re interested in employment opportunities at Electro, please email us: <a class="text-blue text-decoration-on" href="mailto:contact@yourstore.com">contact@yourstore.com</a></p>
        </div>
    </div>

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
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
            <div class="js-slide">
                <a href="#" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
            <div class="js-slide">
                <a href="#" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
            <div class="js-slide">
                <a href="#" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
            <div class="js-slide">
                <a href="#" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
            <div class="js-slide">
                <a href="#" class="link-hover__brand">
                    <img class="img-fluid m-auto max-height-50" src="https://demo3.madrasthemes.com/electro/v2/wp-content/uploads/2016/03/themeforest.png" alt="Image Description">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Brand Carousel -->
