<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\pages\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="card-title mb-4">
                <?= $this->title ?>
            </h4>
            <div class="btns">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="table-responsive2">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'keywords',
                    'descriptions',
                    'name',
                    [
                        'attribute' => 'alias',
                        'value' => \common\traits\HelperTrait::domain() . "/{$model->alias}"
                    ],
                    [
                        'attribute' => 'text',
                        'format' => 'raw'
                    ],
                    'status',
                ],
            ]) ?>

        </div>
    </div>
</div>
