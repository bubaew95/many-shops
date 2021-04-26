<?php

namespace common\models\products;

use common\models\shops\Shops;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * This is the ActiveQuery class for [[\common\models\products\Products]].
 *
 * @see \common\models\products\Products
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere([Products::tableName() . '.active' => 1]);
    }

    /**
     * @return ProductsQuery
     */
    public function mySelect()
    {
        return $this->select([
            Products::tableName(). '.*',
            Shops::tableName(). '.logo',
            Shops::tableName(). '.alias',
            Shops::tableName(). '.title',
        ]);
    }

    /**
     * @param int $id
     * @return Object|null
     */
    public function findOne(int $id, string $alias) :? object
    {
        return $this->shopProduct()->andWhere([
            Products::tableName() . '.id' => $id,
            Products::tableName() . '.alias' => $alias
        ])->active()->one();
    }

    /**
     * Проверяем активен ли магазин или нет
     * @return ProductsQuery
     */
    public function shopProduct()
    {
        $shopTableName = Shops::tableName();
        return $this->innerJoinWith('shop')->andWhere([
            $shopTableName . '.active' => 1
        ]);
    }

    /**
     * Получение товаров магазина
     * @param $shopName
     * @return ProductsQuery
     */
    public function shopProducts($shopName)
    {
        $shopTableName = Shops::tableName();
        return $this->shopProduct()->andWhere([
            $shopTableName . '.alias' => $shopName
        ])->active();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\products\Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\products\Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
