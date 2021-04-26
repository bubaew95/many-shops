<?php
    use common\traits\OrderTrait;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php foreach ($model as $key => $item) : ?>

    <?php $url = Url::to(['/catalog/view/index', 'alias' => $item->alias, 'id' => $item->id]); ?>

    <?php $nClassOne = count($model) == ($key + 1) ? "{$classPrI} {$classLast}" : "{$classPrI} {$classFirst}"; ?>

    <li class="<?= $nClassOne?>">
        <div class="<?= $classPrIO?>">
            <div class="<?= $classPrII?>">
                <div class="<?= $classPrIB?>">
                    <div class="mb-2">
                        <?= Html::a('Tablets', [$url], ['class' => 'font-size-12 text-gray-5', 'target' => '_blank']) ?>
                    </div>
                    <h5 class="mb-1 product-item__title">
                        <?= Html::a($item->title, [$url], ['class' => 'text-blue font-weight-bold'])?>
                    </h5>

                    <div class="mb-2 item-img-container">
                        <?= Html::a(
                            Html::img(THUMBS . "/{$item->img}", ['class' => 'img-fluid']),
                            [$url],
                            ['class' => $classImg, 'target' => '_blank']
                        )?>
                     </div>
                    <div class="flex-center-between mb-1">
                        <?php if($item->discount) : ?>
                            <div class="prodcut-price d-flex align-items-center position-relative">
                                <ins class="font-size-20 text-red text-decoration-none">
                                    <?= OrderTrait::price($item->price, $item->discount) . RUB ?>
                                </ins>
                                <del class="font-size-12 tex-gray-6 position-absolute bottom-100">
                                    <?= $item->price . RUB ?>
                                </del>
                            </div>
                        <?php else : ?>
                            <div class="prodcut-price">
                                <div class="text-gray-100">
                                    <?= $item->price . RUB ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="d-none d-xl-block prodcut-add-cart">
                            <?= Html::a(
                                '<i class="ec ec-add-to-cart"></i>',
                                ['/shops/cart/addtocart', 'id' => $item->id],
                                ['class' => 'btn-add-cart btn-primary transition-3d-hover']
                            ) ?>
                        </div>
                    </div>
                </div>
                <div class="product-item__footer">
                    <div class="border-top pt-2 flex-center-between flex-wrap">
                        <?= Html::a(
                            '<i class="ec ec-compare mr-1 font-size-15"></i> Сравнить',
                            [],
                            ['class' => 'text-gray-6 font-size-13']
                        ) ?>
                        <?= Html::a(
                            '<i class="ec ec-favorites mr-1 font-size-15"></i> В избранное',
                            [],
                            ['class' => 'text-gray-6 font-size-13']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </li>


<?php endforeach ?>