<?php
$this->title = $title;
$params = Yii::$app->params;
?>

<section class="user-pa">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>

        <div class="row">

            <?php if($params['isMobile']) :?>

                <div class="col-md-12 personal-area">
                    <?= \common\widgets\Alert::widget(); ?>

                    <?= $this->render("{$action}", compact('model')) ?>
                </div>

            <?php else : ?>

                <div class="col-md-3">
                    <?= $this->render('_menu') ?>
                </div>
                <div class="col-md-9 personal-area">
                    <?= \common\widgets\Alert::widget(); ?>

                    <?= $this->render("{$action}", compact('model')) ?>
                </div>

            <?php endif ?>


        </div>

    </div>
</section>
