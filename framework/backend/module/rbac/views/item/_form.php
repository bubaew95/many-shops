<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\module\rbac\models\AuthItemModel */
?>
<?php $form = ActiveForm::begin(['id' => 'checkForm']); ?>
    <div class="card ">

        <div class="card-header header-elements-inline d-flex justify-content-between">
            <h5 class="card-title"><?= $this->title?></h5>
            <div class="header-elements">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <div class="card-body">
            <div class="auth-item-form">



                <?php echo $form->field($model, 'name')->textInput(['maxlength' => 64]); ?>

                <?php echo $form->field($model, 'description')->textarea(['rows' => 2]); ?>

                <?php echo $form->field($model, 'ruleName')->widget('yii\jui\AutoComplete', [
                    'options' => [
                        'class' => 'form-control',
                    ],
                    'clientOptions' => [
                        'source' => array_keys(Yii::$app->authManager->getRules()),
                    ],
                ]);
                ?>

                <?php echo $form->field($model, 'data')->textarea(['rows' => 6]); ?>



            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>