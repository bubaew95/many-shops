<?php
$this->title = $title;
?>

<section class="user-pa">
    <div class="container white-container">
        <h1 class="title text-center">
            <i class="fas fa-fire-alt"></i>
            <?= $this->title ?>
        </h1>

        <div class="row">
            <div class="col-md-3">
                <?= $this->render('_menu') ?>
            </div>
            <div class="col-md-9 personal-area">
                <?= $this->render("{$action}", compact('model')) ?>
            </div>
        </div>

    </div>
</section>
