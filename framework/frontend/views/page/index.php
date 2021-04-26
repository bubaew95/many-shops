<?php
$this->title = $model->name;
?>

<section class="page">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>
        <div class="page-form p-5">

            <?= $model->text ?>

        </div>
    </div>
</section>