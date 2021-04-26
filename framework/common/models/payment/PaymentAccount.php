<?php

namespace common\models\payment;

use common\models\tarif\Tarif;
use common\models\tarif\TarifQuery;
use common\models\user\Users;
use common\models\user\UsersQuery;
use Yii;

/**
 * This is the model class for table "{{%payment_account}}".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $tarif_id Тариф
 * @property int|null $active Активность
 * @property int|null $free Бесплатный доступ
 * @property int|null $start_date_payment Дата оплаты
 * @property int|null $end_date_payment Дата окончания оплаты
 *
 * @property Tarif $tarif
 * @property Users $user
 */
class PaymentAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payment_account}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tarif_id'], 'required'],
            [['user_id', 'tarif_id', 'active', 'free', 'start_date_payment', 'end_date_payment'], 'integer'],
            [['tarif_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarif::className(), 'targetAttribute' => ['tarif_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'tarif_id' => Yii::t('app', 'Тариф'),
            'active' => Yii::t('app', 'Активность'),
            'free' => Yii::t('app', 'Бесплатный доступ'),
            'start_date_payment' => Yii::t('app', 'Дата оплаты'),
            'end_date_payment' => Yii::t('app', 'Дата окончания оплаты'),
        ];
    }

    /**
     * Gets query for [[Tarif]].
     *
     * @return \yii\db\ActiveQuery|TarifQuery
     */
    public function getTarif()
    {
        return $this->hasOne(Tarif::className(), ['id' => 'tarif_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentAccountQuery(get_called_class());
    }
}
