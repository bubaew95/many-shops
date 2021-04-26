<?php
use yii\helpers\Html;
?>

<?php if($model) : ?>
    <!-- Slider Section -->
    <div class="mb-4">
        <div class="bg-img-hero" style="background-image: url(/public/img/background.jpg);">
            <div class="container min-height-438 overflow-hidden">
                <div class="js-slick-carousel u-slick"
                     data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-2 pl-xl-16 pl-wd-13">

                    <?php foreach($model as $key => $item) : ?>
                        <div class="js-slide">
                            <div class="row min-height-438 pt-7 py-md-0">
                                <div class="col-xl col col-md-12 mt-md-12 mt-lg-12">
                                    <div class="ml-xl-4">
                                        <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                            data-scs-animation-in="fadeInUp">
                                            <?= strtoupper($item->meta_k) ?>
                                        </h6>
                                        <h1 class="font-size-46 text-lh-50 font-weight-light mb-6"
                                            data-scs-animation-in="fadeInUp"
                                            data-scs-animation-delay="200">
                                            <?= strtoupper($item->title) ?>
                                            <stong class="font-weight-bold"><?= $item->discount ?>% SALE</stong>
                                        </h1>
                                        <a href="#" class="btn btn-primary transition-3d-hover rounded-lg  py-2 px-md-7 px-3 font-size-16"
                                           data-scs-animation-in="fadeInUp"
                                           data-scs-animation-delay="300">
                                            Купить
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-6 d-flex align-items-end ml-auto ml-md-0"
                                     data-scs-animation-in="fadeInUp"
                                     data-scs-animation-delay="500">
                                    <div class="item-img-container ml-auto mr-5">
                                        <?= Html::img(THUMBS . "/{$item->img}", ['class' => 'img-fluid'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Section -->
<?php endif ?>