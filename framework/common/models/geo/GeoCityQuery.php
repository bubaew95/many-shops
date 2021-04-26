<?php

namespace common\models\geo;

/**
 * This is the ActiveQuery class for [[GeoCity]].
 *
 * @see GeoCity
 */
class GeoCityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GeoCity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GeoCity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
