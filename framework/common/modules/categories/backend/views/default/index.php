<?php

use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\categories\models\CategorySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <div class="card">
        <div class="card-header header-elements-inline d-flex justify-content-between">
            <h5 class="card-title"><?= Html::encode($this->title)?></h5>

            <?php if(Yii::$app->user->can(ADMIN_ROLE)): ?>
                <div class="header-elements float-right">
                    <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                </div>
            <?php endif ?>
        </div>

        <div class="card-body">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function (\common\models\categories\Category $category) {
                        $title = '';
                        if(!$category->isRoot()) {
                            foreach ($category->parents()->with('categoryToShop')->all() as $parent) {
                                $localTitle = $parent->categoryToShop['title'] ?? $parent['title'];
                                $title .= "{$localTitle} <span class='text-warning'>></span> ";
                            }
                        }
                        $title .= $category->categoryToShop->title ?? $category->title;
                        return  $title;
                    }
                ],
//            'id',
//            'icon',
//            'tree',
//            'lft',
//            'rgt',
            //'depth',
            //'position',
            //'block',

            [
                'class'         => ActionColumn::class,
                'width'         => '15%',
                'mergeHeader'   => false,
                'header'        => 'Действия',
                'template'     => Yii::$app->user->can(ADMIN_ROLE)
                    ? '{view} {update} {delete}'
                    : '{update} {delete}',
                'buttonOptions' => [
                    'class' => 'btn',
                    'data-modal' => 'large',
                ],
//                <a class="btn btn-default"
//                href="/admin/1/menu/default/update?id=3"
//                title="Изменить"
//                aria-label="Изменить"
//                data-pjax="0"
//                data-modal="large">
//                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
//                </a>
                'buttons' => [
                    'update' => function($r, $model, $key) {

                        $url = '/menu/default/update';
                        if(!Yii::$app->user->can(ADMIN_ROLE)) {
                            $url = '/menu/default/updatecategory';
                        }

                        return Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                            [ "/{$url}", 'id' => $key],
                            [
                                'title' => 'Изменить',
                                'aria-label' => "Изменить",
                                'class' => 'btn btn-default'
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

        </div>
    </div>
</div>
