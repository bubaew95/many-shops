<?php


namespace frontend\controllers;

use common\models\additionals\AdditionalDrLic;
use common\models\additionals\AdditionalOpport;
use common\models\additionals\AdditionalWorkSchedule;
use common\models\adv\Resume;
use common\models\adv\Vacancy;
use common\models\transport\TransportName;
use common\traits\HelperTrait;
use frontend\models\forms\SearchForm;
use frontend\models\forms\VakancyForm;
use Yii;
use frontend\models\forms\ResumeForm;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;

class SearchController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchForm = new SearchForm();
        $model = [];
        $pages = [];
        if($searchForm->load(Yii::$app->request->get())) {
            if($searchForm->type == 'resume') {
                $searchForm->scenario = SearchForm::SCENARIO_RESUME;
                $query = $this->initialResumeModel();
            }

            if($searchForm->type == 'vacancy') {
                $searchForm->scenario = SearchForm::SCENARIO_VACANCY;
                $query = $this->initialVacancyModel();
            }

            $query = $this->searchParams($query, $searchForm);

            if($query){
                $pagination = $this->pagination($query);
                $model = $pagination['model'];
                $pages = $pagination['pages'];
            }
        }

        return $this->render('index', [
            'model'      => $model,
            'pages'      => $pages,
            'searchForm' => $searchForm
        ]);
    }

    /**
     * Параметры поиска
     * @param $model
     * @param SearchForm $searchForm
     * @return mixed
     */
    private function searchParams($model, SearchForm $searchForm)
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

    /**
     * @param $query
     * @return mixed
     */
    private function pagination($query)
    {
        $countQuery = clone $query;

        $pages      = new Pagination([
            'forcePageParam' => false,
            'pageSizeParam'  => false,
            'totalCount'     => $countQuery->count(),
            'pageSize'       => PERPAGE,
        ]);

        return [
            'model' => $query->offset($pages->offset)->limit($pages->limit)->all(),
            'pages' => $pages
        ];
    }

    /**
     * @param SearchForm $searchForm
     * @return string
     */
    private function initialResumeModel()
    {
        return Resume::find()->active();
    }

    /**
     * @param SearchForm $searchForm
     * @return string
     */
    private function initialVacancyModel()
    {
        return Vacancy::find()->active();
    }

}