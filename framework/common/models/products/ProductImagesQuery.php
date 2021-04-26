<?php

namespace common\models\products;

/**
 * This is the ActiveQuery class for [[\common\models\products\ProductImages]].
 *
 * @see \common\models\products\ProductImages
 */
class ProductImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\products\ProductImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\products\ProductImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
