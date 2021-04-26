<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\shops\Shops */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shops-view">

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
                    'model'      => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'logo',
                            'format'    => 'raw',
                            'value'     => function (\common\models\shops\Shops $shop) {
                                return Html::img(UPLOADS . "/{$shop->logo}", ['height' => 200]);
                            }
                        ],
                        'category_id',
                        'title',
                        'alias',
                        'meta_d',
                        'meta_k',
                        'created_at',
                        'updated_at',
                        'text',
                        [
                            'attribute' => 'active',
                            'format'    => 'raw',
                            'value'     => function (\common\models\shops\Shops $shop) {
                                $statuses = \common\traits\HelperTrait::statusesPublish($shop->active);
                                return "<span class='btn btn-{$statuses['color']}'>{$statuses['title']}</span>";
                            }
                        ]
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
