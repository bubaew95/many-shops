<?php

use yii\helpers\Html;
$model = new \common\models\products\Products();
?>

<div class="attributes-module">

    <div class="card">
        <div class="card-header header-elements-inline d-flex justify-content-between">
            <h5 class="card-title"><?= Html::encode($this->title)?></h5>
            <!--div class="header-elements float-right">
                <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div-->
        </div>

        <div class="card-body">

            <?= \common\modules\eav\backend\admin\widgets\Fields::widget([
                'model'         => $model,
                'categoryId'    => 1,
                'entityName'    => 'Категория',
                'entityModel'   => 'common\models\products\Products',
            ])  ?>

        </div>
    </div>
</div>