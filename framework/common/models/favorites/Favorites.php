<?php

namespace common\models\favorites;

use common\models\adv\Resume;
use common\models\adv\Vacancy;
use common\models\user\User;
use Yii;

/**
 * This is the model class for table "{{%favorites}}".
 *
 * @property int $id
 * @property int|null $resume_id Резюме
 * @property int|null $vacancy_id Вакансия
 * @property int $user_id Пользователь
 *
 * @property Resume $resume
 * @property Users $user
 * @property Vacancy $vacancy
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%favorites}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'vacancy_id', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Резюме',
            'vacancy_id' => 'Вакансия',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
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

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
    }

    /**
     * {@inheritdoc}
     * @return FavoritesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FavoritesQuery(get_called_class());
    }
}
