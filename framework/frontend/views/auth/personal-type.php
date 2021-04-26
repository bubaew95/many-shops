<?php
use yii\helpers\Url;
$this->title = "Тип регистрации";
?>

<!-- Personal type -->
<section class="select-type-user">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>

        <div class="col-md-6 offset-md-3">
            <div class="select-btns p-5">
                <a href="<?= Url::to(['auth/registration', 'type' => 1])?>" class="btn-default">Физическое лицо</a>
                <a href="<?= Url::to(['auth/registration', 'type' => 2])?>" class="btn-default">Юридическое лицо</a>
            </div>
        </div>

    </div>
</section>
<!-- End Personal type -->