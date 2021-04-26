<?php


use common\models\adv\Vacancy;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<div class="table-responsive">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
            'dataProvider'=> $model,
            'summaryOptions' => ['class' => 'text-right'],
            'bordered' => false,
            'pjax' => false,
            'striped' => false,
            'hover' => true,
            'tableOptions' => [
                'class' => 'table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline'
            ],
            'summary' =>false,
            'showPageSummary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    //Ищу работу <?= HelperTrait::preferredPosition($item->preferred_ps)
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'attribute' => '',
                    'value' => function(Vacancy $resume) {
                        return "Ищу водителя";
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'attribute' => 'region_id',
                    'value' => function(Vacancy $resume) {
                        return "{$resume->region->name}, {$resume->city->name}";
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'attribute' => 'price_start',
                    'header' => 'Заработная плата',
                    'value' => function(Vacancy $resume) {
                        return "от {$resume->price_start} ₽ до {$resume->price_end} ₽";
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'filter' => DatePicker::widget([
                         'model' => $searchModel,
                         'name' => 'ResumeSearch[created_at]',
                         'value' => $searchModel->created_at,
                         'pluginOptions' => [
                             'format' => 'yyyy-mm-dd',
                             'autoclose' => true,
                         ]
                     ]),
                    'value' => function(Vacancy $resume) {
                        return \common\traits\DateTrait::convertMonth($resume->created_at, 'datetime');
                    },
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'attribute' => 'status',
                    'filter' => \common\traits\HelperTrait::statuses(),
                    'value' => function(Vacancy $resume) {
                        return \common\traits\HelperTrait::statuses($resume->status);
                    },
                    'contentOptions'=>function ($model, $key, $index, $column){
                        return ['class' => \common\traits\ColorTrait::COLORS_STATUS[$model->status] . ' text-white'];
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'width' => '15%',
                    'mergeHeader' => false,
                    'template' => '{view} {update} {delete} {status}',
                    'header' => 'Действия',
                    'buttonOptions' => [
                        'class' => 'btn btn-link',
                        'data-modal' => 'large',
                    ],
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a(
                                '<i class="fas fa-eye"></i>',
                                \yii\helpers\Url::to(['vacancy/view', 'id' => $model->id, 'alias' => $model->created_at]),
                                ['class' => 'gridview-btn btn btn-primary btn-sm']
                            );
                        },
                        'update' => function($url, $model) {
                            return Html::a(
                                '<i class="fas fa-edit"></i>',
                                \yii\helpers\Url::to(['user/vacancy', 'id' => $model->id]),
                                ['class' => 'gridview-btn btn btn-info btn-sm']
                            );
                        },
                        'delete' => function($url, $model) {
                            return Html::a(
                                '<i class="fas fa-trash"></i>',
                                \yii\helpers\Url::to(['user/vacancy', 'id' => $model->id, 'event' => 'delete']), [
                                    'class' => 'gridview-btn btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Вы уверены что хотите удалить резюме?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        },
                        'status' => function($url, $model) {
                            if(!in_array($model->status, [1,2])) return null;
                            $title = $model->status == 1 ? 'Снять с публикации' : 'Опубликовать';

                            return Html::a($title,
                                \yii\helpers\Url::to(['vacancy/status']), [
                                    'id'    => 'adv-status',
                                    'class' => 'gridview-btn d-block mt-1 btn btn-dark btn-sm',
                                    'data'  => [
                                        'id'      => $model->id,
                                        'status'  => $model->status,
                                        'title'   => "Вы уверены что хотите {$title} резюме?",
                                    ],
                                ]
                            );
                        },
                    ]
                ],
            ],
            'toggleDataContainer' => ['class' => 'btn-group-sm'],
            'exportContainer' => ['class' => 'btn-group-sm']
        ]);
    ?>

    <?php Pjax::end(); ?>
</div>