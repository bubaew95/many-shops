<?php


namespace common\modules\products\frontend\controllers;


use common\models\products\Products;
use common\models\shops\Shops;
use frontend\controllers\BaseController;
use yii\web\HttpException;

class ViewController extends BaseController
{

    public function actionIndex(int $id, string $alias)
    {
        $model = Products::find()->with('productImages', 'shop', 'category')->findOne($id, $alias);

        if(!$model) {
            throw new HttpException(404, 'Товар не найден');
        }
        $this->setMeta( $model->title );
        $this->addViewedItems($id);

        return $this->render('index', compact('model'));
    }

    /**
     * Добавляем ID товара в сессию
     * @param int $id
     */
    private function addViewedItems(int $id) : void
    {
        $_SESSION['viewedItems'][$id] = $id;
    }

    public function actionAdd()
    {
        debug(\Yii::$app->request->get());
    }

}