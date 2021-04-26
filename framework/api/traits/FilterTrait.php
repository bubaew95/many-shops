<?php

namespace api\traits;

use common\models\additionals\AdditionalDrLic;
use common\models\additionals\AdditionalOpport;
use common\models\additionals\AdditionalWorkSchedule;
use common\models\transport\TransportName;
use frontend\models\forms\SearchForm;

class FilterTrait
{
    /**
     * Параметры поиска
     * @param $model
     * @param SearchForm $searchForm
     * @return mixed
     */
    public static function searchParams($model, $searchForm)
    {
        //Поиск по транспортам
        if($searchForm->transport_id) {
            $model->joinWith('linkTransport')->andWhere([
                TransportName::tableName() . '.id' => $searchForm->transport_id
            ]);
        }

        //Поиск по ВУ
        if($searchForm->driver_licence_id) {
            $model->joinWith('linkDrLic')->andWhere([
                AdditionalDrLic::tableName() . '.id' => $searchForm->driver_licence_id
            ]);
        }

        //Поиск по графику работы
        if($searchForm->work_schedule_id) {
            $model->joinWith('linkWorkSchedule')->andWhere([
                AdditionalWorkSchedule::tableName() . '.id' => $searchForm->work_schedule_id
            ]);
        }

        //Поиск по региону
        if($searchForm->region) {
            $model->andWhere(['region_id' => $searchForm->region]);
        }

        //Поиск по городу
        if($searchForm->city) {
            $model->andWhere(['city_id' => $searchForm->city]);
        }

        //Поиск по транспортам
        if($searchForm->opport_id) {
            $model->joinWith('linkOpport')->andWhere([
                AdditionalOpport::tableName() . '.id' => $searchForm->opport_id
            ]);
        }

        if($searchForm->q) {
            $model->joinWith('linkTransport')->andWhere([
                'like',
                TransportName::tableName() . '.value',
                $searchForm->q
            ]);
        }

        return $model;
    }

}