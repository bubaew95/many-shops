<?php

namespace common\models\user;

use Yii;

/**
 * This is the model class for table "users_ind".
 *
 * @property int $id
 * @property int|null $user_id Пользователь
 * @property string $firstname Фамилия
 * @property string $name Имя
 * @property string $lastname Отчество
 * @property string $birthday Дата рождения
 * @property string $city Город
 * @property string $address Адрес
 * @property integer $postal_code Почтовый индекс
 *
 * @property User $user
 */
class UsersInd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users_ind}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'postal_code'], 'integer'],
            [['firstname', 'name', 'lastname'], 'required'],
            [['firstname', 'name', 'lastname', 'birthday', 'city', 'address'], 'string', 'max' => 255],
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
            'firstname' => 'Фамилия',
            'name' => 'Имя',
            'lastname' => 'Отчество',
            'birthday' => 'Дата рождения',
            'city' => 'Город',
            'address' => 'Адрес',
            'postal_code' => 'Почтовый индекс',
        ];
    }

    public function fullName()
    {
        return "{$this->firstname} {$this->name} {$this->lastname}";
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
}
