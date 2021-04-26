<?php

namespace common\models\statuses;

use common\models\orders\Orders;
use common\models\orders\OrdersQuery;
use Yii;

/**
 * This is the model class for table "{{%statuses}}".
 *
 * @property int $id
 * @property string $title Название
 * @property string $color Цвет
 *
 * @property Orders[] $orders
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%statuses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'color'], 'string', 'max' => 100],
            [['title'], 'unique'],
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
            'color' => Yii::t('app', 'Цвет'),
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrdersQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['status_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StatusesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusesQuery(get_called_class());
    }
}
