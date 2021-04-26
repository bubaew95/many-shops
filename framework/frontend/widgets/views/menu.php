<?php
use yii\helpers\Url;
?>
<?php if($model) : ?>
    <ul class="list-unstyled flex-column">

        <?php if($items) : ?>
            <?php foreach ($items as $item): ?>
                <li>
                    <a href="<?= \yii\helpers\Url::to([$item['link']])?>">
                        <?= $item['name']?>
                    </a>
                </li>
            <?php endforeach ?>
        <?php endif ?>

        <?php foreach ($model as $item) : ?>
            <?php
                $page = is_null($item['page_id']) ? Url::to([$item['link']]) : Url::to(["page/index", 'alias' => $item['page_id']]);
            ?>
            <li>
                <a href="<?= $page?>">
                    <?= $item['name']?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
