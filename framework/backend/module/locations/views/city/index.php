<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\geo\GeoRegions;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\module\locations\models\GeoCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Geo Cities');
$this->params['breadcrumbs'][] = $this->title;

$regionModel = GeoRegions::find()->all();
$regions = \yii\helpers\ArrayHelper::map($regionModel, 'id', 'name');

?>
<div class="card ">
    <div class="card-header header-elements-inline  d-flex justify-content-between">
        <h5 class="card-title"><?=  $this->title?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a(
                    "<i class='icon-plus-circle2'></i>&nbsp;&nbsp;" . Yii::t('app', 'Create Geo City'),
                    ['create'],
                    ['class' => 'btn btn-success btn-sm popap']
                ) ?>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">

        </p>
    </div>
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
        <div class="geo-city-index">

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' =>false,
                'tableOptions' => [
                    'class' => 'table datatable-html dataTable no-footer'
                ],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'contentOptions' => [
                            'width' => '10%',
                            'class' => 'text-center',
                        ],
                    ],
                    [
                        'attribute' => 'region_id',
                        'filter' => Select2::widget([
                            'name' => 'GeoCitySearch[region_id]',
                            'data' => $regions,
                            'options' => ['placeholder' => 'Регион'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                        'value' => function($model) {
                            return $model->region->name;
                        }
                    ],
                    'name',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttonOptions' => [
                            'class' => 'btn popap'
                        ],
                        'buttons' => [
                            'view' => function($url) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn',
                                    'title' => 'Просмотр',
                                    'aria-label' => "Просмотр",
                                    'data-pjax' => "0"
                                ]);
                            }
                        ],
                        'contentOptions' => [
                            'width' => '25%',
                            'class' => 'text-center',
                        ],
                        'header' => 'Действия',
                        'headerOptions' => [
                            'style' => 'color:#2196f3',
                            'class' => 'text-center'
                        ],
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>

    </div>
</div>


