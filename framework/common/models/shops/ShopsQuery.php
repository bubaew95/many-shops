<?php

namespace common\models\shops;

/**
 * This is the ActiveQuery class for [[Shops]].
 *
 * @see Shops
 */
class ShopsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return Shops[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shops|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
