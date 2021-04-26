<?php

namespace common\models\orders;

use common\traits\HelperTrait;

/**
 * This is the ActiveQuery class for [[Orders]].
 *
 * @see Orders
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @param int $shop_id
     */
    public function viewShopOrders(int $shop_id = 0)
    {
        $shop_id = $shop_id == 0 ? HelperTrait::get('shop_id') : $shop_id;
        return $this->joinWith('orderItems')
            ->andWhere([OrderItems::tableName() . '.shop_id' => $shop_id]);
    }

    /**
     * {@inheritdoc}
     * @return Orders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Orders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
