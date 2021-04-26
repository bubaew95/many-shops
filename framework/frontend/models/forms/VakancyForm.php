<?php
namespace frontend\models\forms;

use common\models\adv\Vacancy;
use yii\helpers\ArrayHelper;

class VakancyForm extends Vacancy {

    public $categoryTr;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge([
            [['transport_id', 'driver_licence_id'], 'required'],
            [['work_schedule_id'], 'safe']
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge( parent::attributeLabels(), [
            'categoryTr' => 'Категория ТР',
            'price_start' => 'от',
            'price_end' => 'до',
            'driver_licence_id' => 'Категория ВУ',
            'work_schedule_id' => ''
        ]);
    }

}