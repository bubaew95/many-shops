<?php
use common\traits\HelperTrait;
use yii\helpers\Url;
?>

<div class="row">
    <?php foreach($model as $item) : ?>
        <div class="<?= $classes ?>">
            <div class="item">

                <?php if(!Yii::$app->user->isGuest) : ?>
                    <span class="adv-type btn" data-id="<?= $item->id?>" data-type="<?= $isVacancy ? 'vacancy' : 'resume'?>">
                        <?= $item->favorite ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>'?>
                    </span>
                <?php endif ?>

                <a href="<?= Url::to([$url, 'id' => $item->id, 'alias' => $item->created_at])?>">
                    <div class="adv-company">
                        <div>
                            <div class="rounded-circle img" style="background-image: url('/<?= $item->user->image?>')"></div>
                        </div>
                        <div class="company-name">
                            <?= $item->user->type === 1
                                ? $item->userInd->fullName()
                                : $item->userLeg->orgName();
                            ?>
                        </div>
                    </div>
                    <div class="adv-info">
                        <span class="adv-info-type">
                            <?php if($isVacancy) : ?>
                                Требуются водители
                            <?php else : ?>
                                Ищу работу <?= HelperTrait::preferredPosition($item->preferred_ps)?>
                            <?php endif ?>

                            <div class="region">
                                <?= $item->region->name ?>
                            </div>

                            <div class="technic">
                                <?= HelperTrait::itemsImplode($item->linkTransport, 'value')?>
                            </div>
                        </span>

                        <span class="adv-price text-center">
                            <?= HelperTrait::priceFormat($isVacancy ? $item->price_end : $item->price_start)?> ₽
                        </span>
                    </div>

                    <div class="adv-body">
                        <?= HelperTrait::subStr($isVacancy ? $item->req_driver : $item->briefly_about) ?><br>
                        <span>[Подробнее...]</span>
                    </div>
                </a>

            </div>
        </div>
    <?php endforeach ?>
</div>