<?php

use common\traits\ColorTrait;
use common\traits\HelperTrait;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\pages\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header header-elements-inline d-flex justify-content-between">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements float-right">
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive4">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
                $togle = Yii::$app->user->can(ADMIN_ROLE) ? '{toggleData}' : '';
                echo GridView::widget([
                'dataProvider'=> $dataProvider,
                'filterModel' => $searchModel,
                'summaryOptions' => ['class' => 'text-right'],
                'bordered' => false,
                'pjax' => false,
                'striped' => false,
                'hover' => true,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered  nowrap dataTable no-footer dtr-inline'
                ],
                'panel' => [
                    'heading' => ''
                ],
                'toolbar'=>[
                    $togle
                ],
                'showPageSummary' => false,
                'columns' => [
                    [
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'id',
                        'width' => '100px',
                    ],
                    'name',
                    [
                        'attribute' => 'shop_id',
                        'format' => 'raw',
                        'value' => function(\common\models\pages\Pages $page) {
                            if(!$page->shop) {
                                return '<span class="badge bg-warning">Свободная страница</span>';
                            }
                            return Html::a(
                                $page->shop->title,
                                Url::to( ['/shops/default/view', 'id' => $page->shop->id]),
                                ['class' => 'badge bg-info', 'target' => '_blank']
                            );
                        }
                    ],
                    [
                        'attribute' => 'alias',
                        'value' => function(\common\models\pages\Pages $page) {
                            return HelperTrait::domain() . "/{$page->alias}";
                        }
                    ],
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
                    [
                        'class' => ActionColumn::class,
                        'width' => '15%',
                        'mergeHeader' => false,
                        'header' => 'Действия',
                        'buttonOptions' => [
                            'class' => 'btn',
                            'data-modal' => 'large',
                        ],
                    ],
                ],
                'toggleDataContainer' => ['class' => 'btn-group-sm'],
                'exportContainer' => ['class' => 'btn-group-sm']
            ]);
            ?>


        </div>
    </div>
</div>
