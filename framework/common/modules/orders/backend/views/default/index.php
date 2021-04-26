<?php

use common\models\orders\Orders;
use common\traits\DateTrait;
use common\traits\OrderTrait;
use kartik\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\orders\models\OrdersSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <div class="card">
        <div class="card-header header-elements-inline d-flex justify-content-between">
            <h5 class="card-title"><?= Html::encode($this->title)?></h5>
            <div class="header-elements float-right">
                <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>

        <div class="card-body">


            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'width' => '3%',
                    ],
                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'value' => function (Orders $order) {
                            return Html::a(
                                $order->user->getName(),
                                \yii\helpers\Url::to(['/users/view', 'id' => $order->user->id])
                            );
                        }
                    ],
                    [
                        'attribute' => 'qty',
                        'width'     => '5%',
                        'value' => function(Orders $order) {
                            return count($order->orderItems);
                        },
                        'contentOptions' => function (){
                            return ['class' => 'text-center'];
                        },
                    ],
                    [
                        'attribute' => 'amount',
                        'width'     => '7%',
                        'format'    => 'raw',
                        'value' => function(Orders $order) {
                            return OrderTrait::sum($order->orderItems, true, true);
                        },
                        'contentOptions' => function (){
                            return ['class' => 'text-right text-success font-weight-bold'];
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'width'     => '10%',
                        'value'     => function(Orders $order) {
                            return DateTrait::convert($order->created_at, 'datetime');
                        },
                        'contentOptions' => function (){
                            return ['class' => 'text-center'];
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'width'     => '10%',
                        'value'     => function(Orders $order) {
                            return DateTrait::convert($order->updated_at, 'datetime');
                        },
                        'contentOptions' => function (){
                            return ['class' => 'text-center'];
                        },
                    ],
                    [
                        'class'     => \kartik\grid\DataColumn::class,
                        'vAlign'    => \kartik\grid\GridView::ALIGN_MIDDLE,
                        'attribute' => 'status',
                        'width'     => '5%',
                        'filter'    => \common\traits\HelperTrait::MODEL_STATUS,
                        'format'    => 'raw',
                        'value'     => function($model) {
                            $status = $model->ordersStatus->status;
                            if(!$status) {
                                return Html::tag('span', 'В обработке', [ 'class' => "badge bg-warning"]);
                            }

                            return Html::tag(
                                'span',
                                $status->title,
                                [ 'class' => "badge bg-" . $model->ordersStatus->status->color ]
                            );
                        },
                        'contentOptions' => function ($model, $key, $index, $column){
                            return ['class' => 'text-white text-center'];
                        },
                    ],
                    [
                        'class'         => ActionColumn::class,
                        'width'         => '15%',
                        'mergeHeader'   => false,
                        'header'        => 'Действия',
                        'buttonOptions' => [
                            'class' => 'btn',
                            'data-modal' => 'large',
                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
