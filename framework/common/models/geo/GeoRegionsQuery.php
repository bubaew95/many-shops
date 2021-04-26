<?php

namespace common\models\geo;

/**
 * This is the ActiveQuery class for [[GeoRegions]].
 *
 * @see GeoRegions
 */
class GeoRegionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GeoRegions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GeoRegions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
