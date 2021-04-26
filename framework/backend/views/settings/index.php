<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title  = 'Настройки';
?>
<?php $form = ActiveForm::begin(['id' => 'site-settings-form']); ?>
<div class="card">
    <div class="card-header header-elements-inline d-flex justify-content-between">
        <h5 class="card-title"><?=  $this->title?></h5>
        <div class="header-elements">
            <?= Html::a(Yii::t('app', 'Clear cache settings'), ['clear-settings-cache'], [
                'class' => 'btn btn-info',
                'data-confirm' => 'Вы уверены что хотите очистить кеш настроек?',
                'data-method' => 'post',
                'data-pjax' => '0',
            ]) ?>

            <?= Html::a(Yii::t('app', 'Clear cache all'), ['clear-cache'], [
                'class' => 'btn btn-danger',
                'data-confirm' => 'Вы уверены что хотите очистить весь кеш?',
                'data-method' => 'post',
                'data-pjax' => '0',
            ]) ?>

            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#default" role="tab" aria-selected="true">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">Основные</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#mailer" role="tab" aria-selected="false">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Почта</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#counters" role="tab" aria-selected="false">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">Счетчики</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#advanced" role="tab" aria-selected="false">
                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                    <span class="d-none d-sm-block">Дополнительное</span>
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane p-3 active" id="default" role="tabpanel">
                <?= $form->field($model, 'siteName')->textInput() ?>

                <?= $form->field($model, 'siteDescription')->textarea(['rows' => 5]) ?>

                <?= $form->field($model, 'siteKeywords')->textarea(['rows' => 5]) ?>
                <?php $form->field($model, 'siteLogo')->textInput() ?>
                <?php $form->field($model, 'siteFavicon')->textInput() ?>
            </div>
            <div class="tab-pane p-3" id="mailer" role="tabpanel">

                <?= $form->field($model, 'selectSmtp')->dropDownList([
                    'false' => 'Использовать стандартный',
                    'true'  => 'Использовать SMTP'
                ]) ?>

                <?= $form->field($model, 'mailHost')->textInput() ?>
                <?= $form->field($model, 'mailPort')->textInput() ?>
                <?= $form->field($model, 'mailEncryption')->dropDownList([
                    'ssl' => 'SSL',
                    'tls' => 'TLS'
                ]) ?>
                <?= $form->field($model, 'mailUsername')->textInput() ?>
                <?= $form->field($model, 'mailPassword')->passwordInput() ?>
            </div>
            <div class="tab-pane p-3" id="counters" role="tabpanel">
                <?= $form->field($model, 'countersHeader')->textarea(['rows' => 10]) ?>
                <?= $form->field($model, 'countersFooter')->textarea(['rows' => 10]) ?>
            </div>
            <div class="tab-pane p-3" id="advanced" role="tabpanel">
                <?= $form->field($model, 'phone')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
            </div>
        </div>

    </div>

</div>
<?php ActiveForm::end(); ?>
