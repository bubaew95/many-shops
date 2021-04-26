<?php

use yii\helpers\Html;
use yii\helpers\Json;
use backend\module\rbac\RbacAsset;

RbacAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \backend\module\rbac\models\AssignmentModel */
/* @var $usernameField string */

$userName = $model->user->{$usernameField};
$this->title = Yii::t('yii2mod.rbac', 'Assignment : {0}', $userName);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2mod.rbac', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;
$this->render('/layouts/_sidebar');
?>

<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card ">
            <div class="card-header header-elements-inline d-flex justify-content-between">
                <h5 class="card-title"><?= $this->title?></h5>
                <div class="header-elements">
                </div>
            </div>

            <div class="card-body"></div>

            <div class="card-body">
                <div class="assignment-index">
                    <?php echo $this->render('../_dualListBox', [
                        'opts' => Json::htmlEncode([
                            'items' => $model->getItems(),
                        ]),
                        'assignUrl' => ['assign', 'id' => $model->userId],
                        'removeUrl' => ['remove', 'id' => $model->userId],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>

