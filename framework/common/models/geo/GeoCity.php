<?php

namespace common\models\geo;

use common\models\adv\Resume;
use common\models\adv\ResumeQuery;
use common\models\adv\Vacancy;
use common\models\adv\VacancyQuery;
use Yii;

/**
 * This is the model class for table "{{%geo_city}}".
 *
 * @property int $id
 * @property int|null $region_id Регион
 * @property string $name Название
 *
 * @property Resume[] $resumes
 * @property Vacancy[] $vacancies
 */
class GeoCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%geo_city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Регион',
            'name' => 'Название',
        ];
    }

    /**
     * Gets query for [[Resumes]].
     *
     * @return \yii\db\ActiveQuery|ResumeQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Vacancies]].
     *
     * @return \yii\db\ActiveQuery|VacancyQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|VacancyQuery
     */
    public function getRegion()
    {
        return $this->hasOne(GeoRegions::className(), ['id' => 'region_id']);
    }

    /**
     * {@inheritdoc}
     * @return GeoCityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeoCityQuery(get_called_class());
    }
}
