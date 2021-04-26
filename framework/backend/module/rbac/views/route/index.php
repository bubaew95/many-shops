<?php

use yii\helpers\Html;
use yii\helpers\Json;
use backend\module\rbac\RbacRouteAsset;

RbacRouteAsset::register($this);

/* @var $this yii\web\View */
/* @var $routes array */

$this->title = Yii::t('yii2mod.rbac', 'Routes');
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card ">

            <div class="card-header header-elements-inline d-flex justify-content-between">
                <h5 class="card-title"><?= $this->title?></h5>
                <div class="header-elements">
                    <?php echo Html::a(Yii::t('yii2mod.rbac', 'Refresh'), ['refresh'], [
                        'class' => 'btn btn-primary',
                        'id' => 'btn-refresh',
                    ]); ?>
                </div>
            </div>

            <div class="card-body">

            </div>
            <div class="card-body">

                <?php echo $this->render('../_dualListBox', [
                    'opts' => Json::htmlEncode([
                        'items' => $routes,
                    ]),
                    'assignUrl' => ['assign'],
                    'removeUrl' => ['remove'],
                ]); ?>

            </div>
        </div>

    </div>
</div>


