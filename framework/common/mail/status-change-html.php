<?php

use common\traits\HelperTrait;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \common\models\user\User */
$settings = Yii::$app->settings;
?>
<center style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
    <div class="text">
        <h3> Смена статуса </h3>
    </div>
</center>

<table role="presentation" border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Регион</th>
            <th>Город</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?= $model->region->name?>
            </td>

            <td>
                <?= $model->city->name?>
            </td>

            <td>
                <?= \common\traits\HelperTrait::statuses($model->status ) ?>
            </td>

            <td>
                <a href="<?=  HelperTrait::domain() . "/user/{$url}"?>">Перейти к просмотру </a>
            </td>
        </tr>
    </tbody>
</table>
