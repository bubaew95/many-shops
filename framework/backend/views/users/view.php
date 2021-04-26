<?php

use common\models\user\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\user\User */

$this->title = $model->type == 2 ? $model->leg->orgName() : $model->ind->fullName();
$this->params['breadcrumbs'][] = ['label' => "Пользователи", 'url' => ['index']];
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
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="table-responsive">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'image',
                        'format'    => 'raw',
                        'value'     =>  Html::img("/{$model->image}", ['width' => 200])
                    ],
                    'phone',
                    'email:email',
                    [
                        'attribute' => 'type',
                        'value' => $model->type == 1 ? 'Физ.лицо' : 'Юр.лицо'
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function (User $user) {
                            return Html::dropDownList(
                                'status', $user->status, \common\traits\HelperTrait::userStatuses(),
                                [
                                    'id'    => 'change-status',
                                    'style' => 'width: 100%;height: 45px;background: #ccc;',
                                    'class' => \common\traits\HelperTrait::userStatuses($user->status)['color']. ' text-white',
                                    'data-id'   => $user->id,
                                    'data-url' => \yii\helpers\Url::to(['users/change-status'])
                                ]
                            );
                        },
                        'contentOptions' => ['class' => 'p-0'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => \common\traits\DateTrait::convert($model->created_at, 'datetime'),
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => \common\traits\DateTrait::convert($model->updated_at, 'datetime'),
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
