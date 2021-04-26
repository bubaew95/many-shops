<?php

use common\traits\ColorTrait;
use common\traits\HelperTrait;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\products\models\ProductsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
                'class' => 'table datatable-html dataTable no-footer'
        ],
        'showPageSummary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'img',
                'width'     => '10%',
                'format'    => 'raw',
                'contentOptions' => [
                        'class' => 'text-center'
                ],
                'value'     => function (\common\models\products\Products $product) {
                    return Html::img(THUMBS . "/{$product->img}", ['width' => 100]);
                }
            ],
            'title',
            //'meta_d',
            [
                'attribute' => 'category_id',
                'width'     => '10%',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function (\common\models\products\Products $product) {
                    return $product->category->title;
                }
            ],
            [
                'attribute' => 'price',
                'format'    => 'raw',
                'width'     => '10%',
                'contentOptions' => [
                    'class' => 'text-right'
                ],
                'value' => function (\common\models\products\Products $product) {
                    return \common\traits\OrderTrait::viewPrice($product->price, $product->discount);
                }
            ],
            //'meta_k',
            [
                'attribute' => 'created_at',
                'width'     => '10%',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value'     => function(\common\models\products\Products $product) {
                    return \common\traits\DateTrait::convert($product->created_at, 'datetime');
                }
            ],
            //'updated_at',
            [
                'class'     => DataColumn::class,
                'vAlign'    => GridView::ALIGN_MIDDLE,
                'attribute' => 'active',
                'width'     => '5%',
                'filter'    => HelperTrait::MODEL_STATUS,
                'format'    => 'raw',
                'value'     => function($model) {
                    return Html::tag(
                        'span',
                        HelperTrait::MODEL_STATUS[$model->active],
                        [ 'class' => "badge bg" . ColorTrait::COLORS_STATUS[$model->active] ]
                    );
                },
                'contentOptions' => function ($model, $key, $index, $column){
                    return ['class' => 'text-white text-center'];
                },
            ],
            //'text:ntext',
            //'discount',
            //'specifications:ntext',
            //'is_installment',
            //'pre_order_price',
            [
                'class'         => ActionColumn::class,
                'width'         => '15%',
                'mergeHeader'   => false,
                'header'        => 'Действия',
                'buttonOptions' => [
                    'class' => 'btn btn-default',
                    'data-modal' => 'large',
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

        </div>
    </div>
</div>
