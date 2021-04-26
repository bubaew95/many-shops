<?php

namespace common\models\tarif;

use common\models\payment\PaymentAccount;
use common\models\payment\PaymentAccountQuery;
use Yii;

/**
 * This is the model class for table "{{%tarif}}".
 *
 * @property int $id
 * @property string $title Название
 * @property string $alias Алиас
 * @property float $price Цена
 * @property int|null $active Активность
 * @property string $text Описание
 *
 * @property PaymentAccount[] $paymentAccounts
 */
class Tarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tarif}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'text'], 'required'],
            [['price'], 'number'],
            [['active'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 1024],
            [['alias'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'alias' => Yii::t('app', 'Алиас'),
            'price' => Yii::t('app', 'Цена'),
            'active' => Yii::t('app', 'Активность'),
            'text' => Yii::t('app', 'Описание'),
        ];
    }

    /**
     * Gets query for [[PaymentAccounts]].
     *
     * @return \yii\db\ActiveQuery|PaymentAccountQuery
     */
    public function getPaymentAccounts()
    {
        return $this->hasMany(PaymentAccount::className(), ['tarif_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TarifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TarifQuery(get_called_class());
    }
}
