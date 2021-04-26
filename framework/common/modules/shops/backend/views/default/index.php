<?php

use common\traits\ColorTrait;
use common\traits\HelperTrait;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\shops\models\ShopsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shops');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-index">

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
                    'dataProvider'=> $dataProvider,
                    'filterModel' => $searchModel,
                    'summaryOptions' => ['class' => 'text-right'],
                    'bordered' => false,
                    'pjax' => false,
                    'striped' => false,
                    'hover' => true,
                    'panel' => [
                        'type' => \kartik\grid\GridView::TYPE_ACTIVE,
                        'before',
                        'after' => false,
                    ],
                    'tableOptions' => [
                        'class' => 'table table-striped table-bordered  nowrap dataTable no-footer dtr-inline'
                    ],
                    'showPageSummary' => false,
                    'toolbar' => [
                        [
                            'content'=> Html::a(
                                Icon::show('arrow-sync-outline'), ['index'], [
                                'data-pjax' => 0,
                                'class' => 'btn btn-default',
                                'title' => Yii::t('app', 'Reset')
                            ]),
                        ],
                        '{toggleData}',
                    ],
                    'toggleDataOptions' => [
                        'all' => [
                            'icon' => 'resize-full',
                            'label' => 'Показать все',
                            'class' => 'btn btn-default',
                            'title' => 'Показать все'
                        ],
                    ],
                    'columns' => [
                        [
                            'class'     => DataColumn::class,
                            'vAlign'    => GridView::ALIGN_CENTER,
                            'attribute' => 'logo',
                            'format'    => 'raw',
                            'value' => function(\common\models\shops\Shops $shop) {
                                return Html::img(UPLOADS . "/{$shop->logo}", ['width' => 100]);
                            }
                        ],
                        [
                            'class'     => DataColumn::class,
                            'vAlign'    => GridView::ALIGN_MIDDLE,
                            'attribute' => 'title',
                        ],
                        [
                            'class'     => DataColumn::class,
                            'vAlign'    => GridView::ALIGN_MIDDLE,
                            'attribute' => 'category_id',
                            'value' => function(\common\models\shops\Shops $shop) {
                                return $shop->category->title;
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
                            'class'         => ActionColumn::class,
                            'template'      => '{select} {view} {update} {delete}',
                            'width'         => '20%',
                            'mergeHeader'   => false,
                            'header'        => 'Действия',
                            'buttonOptions' => [
                                'class' => 'btn  btn-sm',
                                'data-modal' => 'large',
                            ],
                            'buttons' => [
                                'select' => function($url, $model) {
                                    $adminRole = Yii::$app->user->can(ADMIN_ROLE);

                                    if(!$adminRole && !in_array($model->active, [0, 1])) return '';
                                    return Html::a('Выбрать', \yii\helpers\Url::to(['/site/info', 'shop_id' => $model->id]), [
                                            'class' => 'btn btn-info btn-sm'
                                    ]);
                                }
                            ]
                        ],
                    ],
                    'toggleDataContainer' => ['class' => 'btn-group-sm'],
                    'exportContainer' => ['class' => 'btn-group-sm']
                ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
