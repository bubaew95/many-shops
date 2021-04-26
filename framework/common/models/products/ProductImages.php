<?php

namespace common\models\products;

use Yii;

/**
 * This is the model class for table "{{%product_images}}".
 *
 * @property int $id
 * @property int $product_id Продукт
 * @property string $image Картинка
 * @property int|null $is_base Базовое изображение
 *
 * @property Products $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'image'], 'required'],
            [['product_id', 'is_base'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Продукт'),
            'image' => Yii::t('app', 'Картинка'),
            'is_base' => Yii::t('app', 'Базовое изображение'),
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
     * {@inheritdoc}
     * @return ProductImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductImagesQuery(get_called_class());
    }
}
