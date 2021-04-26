<?php
namespace api\controllers;


use Codeception\Lib\Generator\Helper;
use common\models\geo\GeoCity;
use common\models\geo\GeoRegions;
use common\models\transport\TransportCategory;
use common\models\transport\TransportName;
use common\models\user\User;
use common\traits\HelperTrait;
use PHPUnit\TextUI\Help;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\rest\Controller;

/**
 * Site controller
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\user\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'token',
        ];
        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        return User::find()
            ->with(['leg', 'ind'])
            ->where(['id' => Yii::$app->user->identity->getId()])
            ->asArray()
            ->one();
    }
}
