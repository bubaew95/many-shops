<?php

use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\menu\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card ">

    <div class="card-header header-elements-inline d-flex justify-content-between">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements float-right">
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm popap']) ?>
        </div>
    </div>

    <div class="card-body"></div>

    <div class="card-body">
        <div class="table-responsive">

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
                        'class' => DataColumn::class,
                        'vAlign' => GridView::ALIGN_MIDDLE,
                        'attribute' => 'id',
                        'width' => '5%',
                    ],
                    [
                        'attribute' => 'name',
                        'width' => '50%'
                    ],
                    [
                        'attribute' => 'link',
                        'value' => function(\common\models\menu\Menu $menu) {
                            return is_null($menu->page_id)
                                    ? $menu->link
                                    : \common\traits\HelperTrait::domain() . "/{$menu->page_id}";
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{update} {delete}',
                        'width' => '15%',
                        'mergeHeader' => false,
                        'header' => 'Действия',
                        'buttonOptions' => [
                            'class' => 'btn popap',
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
