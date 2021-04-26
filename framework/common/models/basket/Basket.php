<?php

namespace common\models\basket;

use common\models\products\Products;
use common\models\products\ProductsQuery;
use common\models\shops\Shops;
use common\models\shops\ShopsQuery;
use common\models\user\Users;
use common\models\user\UsersQuery;
use Yii;

/**
 * This is the model class for table "{{%basket}}".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $shop_id Магазин
 * @property int $created_at Дата создания
 * @property int $updated_at Дата редактирования
 * @property int $product_id Продукт
 * @property int|null $qty Кол-во
 *
 * @property Products $product
 * @property Shops $shop
 * @property Users $user
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%basket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'shop_id', 'created_at', 'updated_at', 'product_id'], 'required'],
            [['user_id', 'shop_id', 'created_at', 'updated_at', 'product_id', 'qty'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
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
            'shop_id' => Yii::t('app', 'Магазин'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата редактирования'),
            'product_id' => Yii::t('app', 'Продукт'),
            'qty' => Yii::t('app', 'Кол-во'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ProductsQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
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
     * @return BasketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BasketQuery(get_called_class());
    }
}
