<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\eav\models\EavAttribute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Eav Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eav-attribute-view">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-4">
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
            'entityId',
            'typeId',
            'type',
            'name',
            'label',
            'defaultValue',
            'defaultOptionId',
            'description',
            'order',
            'categoryId',
        ],
    ]) ?>

            </div>
        </div>
    </div>
</div>
