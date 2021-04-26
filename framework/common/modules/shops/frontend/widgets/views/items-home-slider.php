<?php
    use common\traits\OrderTrait;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php $items_blocks = array_chunk($model, $tabItems, true); ?>

<?php foreach ($items_blocks as $keyBlock => $model) : ?>

    <?php if(!$isUl) : ?>
        <div class="tab-pane fade pt-2 <?= $keyBlock == 0 ? 'show active' : null ?>" id="pills-example-<?= ($keyBlock + 1) ?>" role="tabpanel" aria-labelledby="pills-example-<?= ($keyBlock + 1) ?>-tab" data-target-group="groups">
        <ul class="row list-unstyled products-group no-gutters">
    <?php else : ?>
        <div <?= $divOptions ?>>
        <ul <?= $ulOptions ?>>
    <?php endif?>

        <?= $this->render(
            $subTemplate,
            [
                'model'      => $model,
                'classPrI'   => $classPrI,
                'classPrIO'  => $classPrIO,
                'classPrII'  => $classPrII,
                'classImg'   => $classImg,
                'classPrIB'  => $classPrIB,
                'classFirst' => $classFirst,
                'classLast'  => $classLast,
                'tabItems'   => $tabItems,
            ]
        )?>

    </ul>
    </div>

<?php endforeach ?>

