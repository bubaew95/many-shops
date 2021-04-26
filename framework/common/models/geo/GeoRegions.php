<?php

namespace common\models\geo;

use Yii;

/**
 * This is the model class for table "{{%geo_regions}}".
 *
 * @property int $id
 * @property string $name Название
 *
 * @property Resume[] $resumes
 * @property Vacancy[] $vacancies
 */
class GeoRegions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%geo_regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        return $this->hasMany(Resume::className(), ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Vacancies]].
     *
     * @return \yii\db\ActiveQuery|VacancyQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['region_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return GeoRegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeoRegionsQuery(get_called_class());
    }
}
