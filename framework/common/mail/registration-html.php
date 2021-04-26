<?php

use common\traits\HelperTrait;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \common\models\user\User */
$settings = Yii::$app->settings;
$domain = HelperTrait::domain();
?>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            <div class="text">
                <h3> <?= $user->getName() ?>, вы успешно зарегистрировались на нашем сайте  </h3>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <div class="text-author">
                <img src="<?= "{$domain}/{$user->image}"?>" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
                <h3 class="name"><?= $user->getName() ?></h3>
                <p>
                    <a href="<?= "{$domain}/auth/login"?>" class="btn btn-primary">Войти</a>
                </p>
            </div>
        </td>
    </tr>
</table>
