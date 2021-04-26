<?php
namespace api\controllers;


use Codeception\Lib\Generator\Helper;
use common\models\geo\GeoCity;
use common\models\geo\GeoRegions;
use common\models\transport\TransportCategory;
use common\models\transport\TransportName;
use common\traits\HelperTrait;
use PHPUnit\TextUI\Help;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\rest\Controller;

/**
 * Site controller
 */
class AdditionalsController extends Controller
{
    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * Категория водительского уд-я
     * @return mixed
     */
    public function actionDl()
    {
        return HelperTrait::categoryDL();
    }

    /**
     * График работы
     * @return array
     */
    public function actionWorkschedule()
    {
        return HelperTrait::workSchedule();
    }

    /**
     * Образование
     * @return string|string[]
     */
    public function actionEducation()
    {
        return HelperTrait::education();
    }

    /**
     * Навыки
     * @return array
     */
    public function actionSkills()
    {
        return HelperTrait::skills();
    }

    /**
     * Возможности
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionOpport()
    {
        return HelperTrait::opportList();
    }

    /**
     * Предпочтительная должность
     * @return array
     */
    public function actionPrefosition()
    {
        return HelperTrait::preferredPosition();
    }

}
