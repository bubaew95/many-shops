<?php

namespace common\models\delivery;

use common\models\shops\Shops;
use common\models\shops\ShopsQuery;
use Yii;

/**
 * This is the model class for table "{{%delivery}}".
 *
 * @property int $id
 * @property int $shop_id Магазин
 * @property string $title Название
 * @property float|null $amount Сумма
 * @property int $created_at Дата создания
 *
 * @property Shops $shop
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%delivery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'created_at'], 'required'],
            [['shop_id', 'created_at'], 'integer'],
            [['amount'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'title' => Yii::t('app', 'Title'),
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery|ShopsQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    /**
     * {@inheritdoc}
     * @return DeliveryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DeliveryQuery(get_called_class());
    }
}
