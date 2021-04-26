<?php

namespace common\models\user\address;

use common\models\geo\GeoCity;
use common\models\geo\GeoCityQuery;
use common\models\geo\GeoRegions;
use common\models\geo\GeoRegionsQuery;
use common\models\user\User;
use common\models\user\UserQuery;
use Yii;

/**
 * This is the model class for table "{{%user_address}}".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $region_id Регион
 * @property int $city_id Город
 * @property string|null $address Адрес
 * @property int|null $post_code Почтовый индекс
 *
 * @property GeoCity $city
 * @property GeoRegions $region
 * @property User $user
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'region_id', 'city_id'], 'required'],
            [['user_id', 'region_id', 'city_id', 'post_code'], 'integer'],
            [['address'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoCity::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoRegions::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'region_id' => 'Регион',
            'city_id' => 'Город',
            'address' => 'Адрес',
            'post_code' => 'Почтовый индекс',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|GeoCityQuery
     */
    public function getCity()
    {
        return $this->hasOne(GeoCity::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|GeoRegionsQuery
     */
    public function getRegion()
    {
        return $this->hasOne(GeoRegions::className(), ['id' => 'region_id']);
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
     * {@inheritdoc}
     * @return UserAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserAddressQuery(get_called_class());
    }
}
