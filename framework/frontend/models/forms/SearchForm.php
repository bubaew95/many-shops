<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class SearchForm extends Model
{

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_VACANCY = 'vacancy';
    const SCENARIO_RESUME = 'resume';

    public $type;
    public $region;
    public $q;

    public $categoryTr;
    public $driver_licence_id;
    public $city;
    public $salary;
    public $work_schedule_id;
    public $opport_id;

    //Резюме
    public $transport_id;
    public $residence;
    public $work_experience;

    //Вакансия
    public $marka;
    public $model;
    public $year;
    public $nationality;
    public $count_drivers;
    public $req_skills;
    public $education;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return[
            [['type'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [
                [
                    'transport_id',
                    'region', 'city', 'driver_licence_id', 'salary', 'work_schedule_id',
                    'categoryTr', 'opport_id', 'q'
                ],
                'safe'
            ],

            [['residence', 'work_experience'], 'safe', 'on' => self::SCENARIO_RESUME], //Резюме
            [['marka', 'model', 'year', 'nationality', 'count_drivers', 'req_skills', 'education'], 'safe', 'on' => self::SCENARIO_VACANCY] //Вакансия
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type' => 'Тип поиска',
            'region' => 'Регион',
            'q' => 'Поиск',
            'work_schedule_id' => 'График работы',
            'is_transport' => 'Наличие собственного транспорта',
            'is_possibility' => 'Возможность командировок по РФ',
            'is_possibility_ab' => 'Возможность командировок за границу',
            'is_long_distance' => 'Междугородние рейсы',
            'is_Inter_flight' => 'Международные рейсы',
            'is_distiller' => 'Перегонщик',
            'is_vailability' => 'Наличие ИП',
            'is_skzi_map' => 'Карта СКЗИ',
            'is_reg_self_imp' => 'Зарегистрирован как самозанятый',
        ];
    }
}