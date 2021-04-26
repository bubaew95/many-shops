<?php

namespace common\models\products;

use common\modules\eav\models\EavAttribute;
use Yii;

/**
 * This is the model class for table "eav_to_products".
 *
 * @property int $id
 * @property int $atr_id
 * @property int $product_id
 *
 * @property Products $product
 * @property EavAttribute $atr
 */
class EavToProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%eav_to_products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['atr_id', 'product_id'], 'required'],
            [['atr_id', 'product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['atr_id'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttribute::className(), 'targetAttribute' => ['atr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'atr_id' => 'Atr ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Atr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAtr()
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'atr_id']);
    }
}
