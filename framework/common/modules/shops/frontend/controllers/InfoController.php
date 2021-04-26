<?php

namespace common\modules\shops\frontend\controllers;

use common\models\products\Products;
use common\models\shops\Shops;
use frontend\controllers\BaseController;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Default controller for the `shops` module
 */
class InfoController extends BaseController
{

    private function shopInfo(string $alias)
    {
        return Shops::find()->where(['alias' => $alias])->active()->one();
    }

    private function products(Shops $shopInfo)
    {
        return Products::find()->where(['shop_id' => $shopInfo->id])->active()->all();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($alias = null)
    {
        $shopInfo   = $this->shopInfo($alias);
        if(!$shopInfo)
            throw new HttpException(404, 'Магазин не найден!');

        $model = $this->products($shopInfo);
        $this->setMeta("Магазин " . strtoupper($shopInfo->title));
        \Yii::$app->shopComponent->setShopInfo($shopInfo);
        return $this->render(
            'index',
            compact('model')
        );
    }
}
