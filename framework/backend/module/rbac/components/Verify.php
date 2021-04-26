<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 18.04.2020
 * Time: 20:49
 */

namespace backend\module\rbac\components;

use Yii;
use yii\base\Behavior;
use yii\web\ForbiddenHttpException;

class Verify extends Behavior
{
    public $actions = null;

    public function events()
    {
        return [
            yii\web\Controller::EVENT_BEFORE_ACTION => 'access'
        ];
    }

    public function access(){
        foreach($this->actions as $action){
            if($this->owner->action->id == $action){
                if (\Yii::$app->user->can(ENTERADMINPANEL)) {
                    throw new ForbiddenHttpException('Доступ закрыт.');
                }
            }
        }
    }
}