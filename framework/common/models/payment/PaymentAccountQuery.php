<?php

namespace common\models\payment;

/**
 * This is the ActiveQuery class for [[PaymentAccount]].
 *
 * @see PaymentAccount
 */
class PaymentAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PaymentAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PaymentAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
