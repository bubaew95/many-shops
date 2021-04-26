<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<section>
    <div class="container white-container">
        <div class="site-error p-5">

            <div class="text-center">
                <h1><?= Html::encode($this->title) ?></h1>

                <div class="d-flex justify-content-center">
                    <img src="/public/img/error.png" height="400">
                </div>

                <div class="error-message mt-5 mb-15 ">
                    <h1>
                        <?= nl2br(Html::encode($message)) ?>
                    </h1>
                </div>

            </div>


        </div>
    </div>

</section>