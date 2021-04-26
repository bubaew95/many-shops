<?php


namespace common\modules\shops\frontend\controllers;


use common\components\Cart;
use common\models\products\Products;
use common\models\shops\Shops;
use frontend\controllers\BaseController;
use Yii;
use yii\web\HttpException;

class CartController extends BaseController
{

    public function actionIndex( )
    {
        return $this->render('index');
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

    public function actionAddtocart($id)
    {
        $product = Products::find()->select(
            ['id', 'shop_id', 'title', 'alias', 'price', 'discount', 'img']
        )->with('shop')->where(['id' => $id])->asArray()->one();

        if(!$product)  throw new HttpException(404, 'Product not found');

        $productItem = $product['shop'];
        unset($product['shop']);
        $product['shop'] = [
            'title' => $productItem['title'],
            'alias' => $productItem['alias'],
            'logo'  => $productItem['logo']
        ];
        Cart::add($id, $product, 1);
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    public function actionRemoveitem($id)
    {
        Cart::removeItem($id);
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    public function actionRemovecart()
    {
        return Cart::clear();
    }

}