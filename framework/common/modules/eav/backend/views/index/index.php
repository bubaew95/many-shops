<?php

use common\modules\eav\traits\EavTrait;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\eav\models\search\EavAttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eav Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-index">

    <div class="card">
        <div class="card-header header-elements-inline d-flex justify-content-between">
            <h5 class="card-title"><?= Html::encode($this->title)?></h5>
            <div class="header-elements float-right">
                <div class="eav-buttons">
                    <?= EavTrait::typeButtons()?>
                </div>
                <?//= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>

        <div class="card-body">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'entityId',
//            'typeId',
//            'type',
            'label',
            'name',
            //'defaultValue',
            //'defaultOptionId',
            //'description',
            //'order',
            //'categoryId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

        </div>
    </div>
</div>
