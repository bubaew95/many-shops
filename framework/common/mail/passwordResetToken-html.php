<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <center>
        <p>Здравствуйте, <?= Html::encode($user->getName()) ?></p>

        <p>Перейдите по ссылке для смены пароля:</p>

        <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

        <small>
            Если вы не отправляли письмо, то просто игнорируйте.
        </small>
    </center>
</div>
