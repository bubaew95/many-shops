<?php

use common\models\user\User;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\user\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Пользователи";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header header-elements-inline d-flex justify-content-between">
        <h5 class="card-title"><?= $this->title?></h5>
    </div>
    <div class="card-body">

        <div class="table-responsive">

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
                    '{export}',
                ],
                'toggleDataOptions' => [
                    'all' => [
                        'icon' => 'resize-full',
                        'label' => 'Показать все',
                        'class' => 'btn btn-default',
                        'title' => 'Показать все'
                    ],
                    'page' => [
                        'icon' => 'resize-small',
                        'label' => 'Страницы',
                        'class' => 'btn btn-default',
                        'title' => 'Постаничная разбивка'
                    ],
                ],
                'export' => [
                    'target' => GridView::TARGET_BLANK,
                    'label' => 'Экспорт',
                    'header' => '<li role="presentation" class="dropdown-header">Экспорт данных</li>',
                ],
                'exportConfig' => [
                    GridView::EXCEL => [
                        'label' => 'Excel',
                        'icon' => 'floppy-remove',
                        'iconOptions' => ['class' => 'text-success'],
                        'showHeader' => true,
                        'showPageSummary' => true,
                        'showFooter' => true,
                        'showCaption' => true,
                        'filename' => 'client_export_excel',
                        'mime' => 'application/vnd.ms-excel',
                        'config' => [
                            'worksheet' => 'ExportWorksheet',
                            'cssFile' => ''
                        ]
                    ],
                    GridView::CSV => [
                        'label' => 'CSV',
                        'icon' => 'floppy-open',
                        'iconOptions' => ['class' => 'text-primary'],
                        'showHeader' => true,
                        'showPageSummary' => true,
                        'showFooter' => true,
                        'showCaption' => true,
                        'filename' => 'client_export_cvs',
                        'mime' => 'application/csv',
                        'config' => [
                            'colDelimiter' => ",",
                            'rowDelimiter' => "\r\n",
                        ]
                    ]
                ],
                'columns' => [
                    [
                        'class'     => DataColumn::class,
                        'vAlign'    => GridView::ALIGN_MIDDLE,
                        'attribute' => 'id',
                        'width'     => '100px',
                    ],
                    [
                        'class'     => DataColumn::class,
                        'vAlign'    => GridView::ALIGN_MIDDLE,
                        'attribute' => 'image',
                        'format'    => 'raw',
                        'value'     => function (User $user) {
                            return Html::img("/{$user->image}", ['width' => 100]);
                        }
                    ],
                    [
                        'class'     => DataColumn::class,
                        'vAlign'    => GridView::ALIGN_MIDDLE,
                        'attribute' => 'Контрагент',
                        'value'     => function(User $user) {
                            return $user->type == 2
                                ? $user->leg->orgName()
                                : $user->ind->fullName();
                        }
                    ],
                    'phone',
                    [
                        'class'     => DataColumn::class,
                        'vAlign'    => GridView::ALIGN_MIDDLE,
                        'attribute' => 'email',
                        'format'    => 'raw',
                        'value'     => function(User $user) {
                            return !empty($user->email) ? $user->email : '<i class="fas fa-times fa-2x text-danger"></i>';
                        }
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function(User $user) {
                            return $user->type == 1 ? 'Физ.лицо' : 'Юр.лицо';
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                        'filter'    => DatePicker::widget([
                            'model' => $searchModel,
                            'name'  => 'ResumeSearch[created_at]',
                            'value' => $searchModel->created_at,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ]
                        ]),
                        'value' => function(User $resume) {
                            return \common\traits\DateTrait::convert($resume->created_at, 'datetime');
                        },
                    ],
                    [
                        'class'     => DataColumn::class,
                        'vAlign'    => GridView::ALIGN_MIDDLE,
                        'attribute' => 'status',
                        'filter'    => \common\traits\HelperTrait::userStatuses(),
                        'value'     => function(User $resume) {
                            return \common\traits\HelperTrait::userStatuses($resume->status)['title'];
                        },
                        'contentOptions'=>function ($model, $key, $index, $column){
                            return ['class' => \common\traits\HelperTrait::userStatuses($model->status)['color'] . ' text-white'];
                        },
                    ],

                    [
                        'class'     => ActionColumn::class,
                        'template'  => '{view} {delete}',
                        'width'     => '15%',
                        'mergeHeader' => false,
                        'header' => 'Действия',
                        'buttonOptions' => [
                            'class' => 'btn btn-link',
                            'data-modal' => 'large',
                        ],
                    ],
                ],
                'toggleDataContainer' => ['class' => 'btn-group-sm'],
                'exportContainer' => ['class' => 'btn-group-sm']
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>

