<?php

namespace common\models\orders;

use common\models\user\User;
use common\models\user\UserQuery;
use common\traits\HelperTrait;
use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property string $ship_name Название доставки
 * @property string $ship_address Адрес доставки
 * @property string $ship_city Город
 * @property string $ship_country Страна
 * @property string $ship_zip Почтовый индекс
 * @property int $created_at Дата создания
 * @property int $updated_at Дата редактирования
 *
 * @property OrderItems[] $orderItems
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    public $orders;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => LinkerBehavior::className(),
                'relations' => [
                    'user_id' => 'user',
                    'orders' => 'orderItemsList'
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [[], 'required'],
            ['orders', 'safe'],
            [['user_id', 'ship_name', 'ship_address', 'ship_city', 'ship_country', 'ship_zip'], 'safe'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['ship_address', 'ship_country'], 'string', 'max' => 255],
            [['ship_city'], 'string', 'max' => 100],
            [['ship_zip'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'ship_name' => Yii::t('app', 'Ship Name'),
            'ship_address' => Yii::t('app', 'Ship Address'),
            'ship_city' => Yii::t('app', 'Ship City'),
            'ship_country' => Yii::t('app', 'Ship Country'),
            'ship_zip' => Yii::t('app', 'Ship Zip'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),

            'name' => 'ФИО',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'qty' => 'Кол-во',
            'amount' => 'Итого',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[LinkDrLics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemsList()
    {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id'])
            ->where([OrderItems::tableName() . '.shop_id' => HelperTrait::get('shop_id')]);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[OrdersToStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersStatus()
    {
        return $this->hasOne(OrdersToStatus::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
