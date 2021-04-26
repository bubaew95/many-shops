<?php

namespace common\models\tarif;

/**
 * This is the ActiveQuery class for [[Tarif]].
 *
 * @see Tarif
 */
class TarifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tarif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tarif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
