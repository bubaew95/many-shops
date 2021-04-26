<?php

namespace common\models\orders;

use common\models\delivery\Delivery;
use common\models\delivery\DeliveryQuery;
use common\models\products\Products;
use common\models\products\ProductsQuery;
use common\models\shops\Shops;
use common\models\shops\ShopsQuery;
use common\models\statuses\Statuses;
use common\models\statuses\StatusesQuery;
use Yii;

/**
 * This is the model class for table "{{%order_items}}".
 *
 * @property int $id
 * @property int $shop_id Магазин
 * @property int $status_id Статус
 * @property float $price Цена
 * @property string|null $image Картинка
 * @property int $product_id Продукт
 * @property int $order_id Заказы
 * @property int|null $qty Кол-во
 * @property string $title Название
 * @property int $delivery_id
 *
 * @property Delivery $delivery
 * @property Orders $order
 * @property Products $product
 * @property Shops $shop
 * @property Statuses $status
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'price', 'product_id',  'title'], 'required'],
            [['status_id','order_id', 'delivery_id'], 'safe'],
            [['shop_id', 'status_id', 'product_id', 'order_id', 'qty', 'delivery_id'], 'integer'],
            [['price'], 'number'],
            [['image'], 'string', 'max' => 500],
            [['title'], 'string', 'max' => 255],
            [['delivery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['delivery_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'status_id' => Yii::t('app', 'Status ID'),
            'price' => Yii::t('app', 'Price'),
            'image' => Yii::t('app', 'Image'),
            'product_id' => Yii::t('app', 'Product ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'qty' => Yii::t('app', 'Qty'),
            'title' => Yii::t('app', 'Title'),
            'delivery_id' => Yii::t('app', 'Delivery ID'),
        ];
    }

    /**
     * Gets query for [[Delivery]].
     *
     * @return \yii\db\ActiveQuery|DeliveryQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery|StatusesQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderItemsQuery(get_called_class());
    }
}
