<?php
namespace api\controllers;


use common\models\geo\GeoCity;
use common\models\geo\GeoRegions;
use common\models\transport\TransportCategory;
use common\models\transport\TransportName;
use Yii;
use yii\filters\Cors;
use yii\rest\Controller;

/**
 * Site controller
 */
class CarsController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors;
    }

    public function actionCategories()
    {
        return TransportCategory::find()->all();
    }

    public function actionType($id)
    {
        return TransportName::find()->where(['tr_cat_id' => $id])->all();
    }
}
