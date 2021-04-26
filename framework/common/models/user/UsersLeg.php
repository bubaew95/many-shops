<?php

namespace common\models\user;

use Yii;

/**
 * This is the model class for table "users_leg".
 *
 * @property int $id
 * @property int|null $user_id Пользователь
 * @property string $org_name Название организации
 * @property string $inn ИНН
 *
 * @property User $user
 */
class UsersLeg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_leg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['org_name', 'inn'], 'required'],
            [['org_name', 'inn'], 'string', 'max' => 255],
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
            'org_name' => 'Название организации',
            'inn' => 'ИНН',
        ];
    }

    public function orgName()
    {
        return $this->org_name;
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
