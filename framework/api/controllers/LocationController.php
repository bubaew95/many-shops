<?php
namespace api\controllers;


use common\models\geo\GeoCity;
use common\models\geo\GeoRegions;
use Yii;
use yii\filters\Cors;
use yii\rest\Controller;

/**
 * Site controller
 */
class LocationController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors;
    }

    public function actionRegions()
    {
        return GeoRegions::find()->all();
    }

    public function actionRegion($id)
    {
        return GeoRegions::find()->where(['id' => $id])->one();
    }

    public function actionCities($id)
    {
        return GeoCity::find()->where(['region_id' => $id])->all();
    }
}
