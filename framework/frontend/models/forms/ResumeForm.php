<?php

namespace frontend\models\forms;

use common\models\adv\Resume;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ResumeForm extends Resume
{

    public $categoryTr;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge( [
            [['transport_id', 'driver_licence_id'], 'required'],
            [['work_schedule_id'], 'safe']
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'categoryTr' => 'Категория ТР',
            'price_start' => 'от',
            'price_end' => 'до',
            'driver_licence_id' => 'Категория ВУ',
            'work_schedule_id' => 'График работы'
        ]);
    }
}