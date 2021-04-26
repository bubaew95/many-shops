<?php

use common\models\user\User;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $gridViewColumns array */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \backend\module\rbac\models\search\AssignmentSearch */

$this->title = Yii::t('yii2mod.rbac', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card ">

            <div class="card-header header-elements-inline d-flex justify-content-between">
                <h5 class="card-title"><?= $this->title?></h5>
                <div class="header-elements">

                </div>
            </div>

            <div class="card-body"></div>

            <div class="card-body">
                <div class="assignment-index">

                    <?php Pjax::begin(['timeout' => 5000]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary' =>false,
                            'tableOptions' => [
                                'class' => 'table datatable-html dataTable no-footer'
                            ],
                            'columns' => [
                                [
                                    'class' => DataColumn::class,
                                    'vAlign' => GridView::ALIGN_MIDDLE,
                                    'attribute' => 'id',
                                    'width' => '5%',
                                ],
                                [
                                    'attribute' => 'ФИО',
                                    'value' => function(User $user) {
                                        return $user->getName();
                                    }
                                ],
                                'phone',
                                'email',
                                [
                                    'header' => Yii::t('yii2mod.rbac', 'Action'),
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}',
                                    'buttonOptions' => [
                                        'class' => 'btn'
                                    ],
                                    'contentOptions' => [
                                        'width' => '15%',
                                        'class' => 'text-center',
                                    ],
                                    'headerOptions' => [
                                        'class' => 'text-center'
                                    ],
                                ],
                            ],
                        ]); ?>

                    <?php Pjax::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>
