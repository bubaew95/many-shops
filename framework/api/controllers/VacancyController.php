<?php


namespace api\controllers;

use api\traits\FilterTrait;
use common\models\adv\Vacancy;
use frontend\models\forms\SearchForm;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\HttpException;

class VacancyController extends ActiveController
{
    public $modelClass = 'common\models\adv\Vacancy';

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \common\filters\Cors::className(),
            'cors'  => [
                'Origin'                           => [$_SERVER["REMOTE_ADDR"], 'http://localhost:3000'],
                'Access-Control-Request-Method'    => ['POST', 'GET', 'OPTIONS', 'DELETE', 'PUT'],
                'Access-Control-Allow-Credentials' => true,
                //'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                'Access-Control-Allow-Headers' => ['authorization','X-Requested-With','content-type', 'some_custom_header']
            ],
        ];
        $behaviors['authenticator'] = [
            'class'      => QueryParamAuth::className(),
            'tokenParam' => 'token',
            'optional'   => ['index', 'view']
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    /**
     * @param $id
     * @return Vacancy|null
     */
    public function actionView($id)
    {
        $item = Vacancy::find()
            ->with([
                'userLeg', 'userInd', 'region', 'city',
                'linkTransport', 'linkDrLic', 'linkWorkSchedule', 'linkOpport'
            ])->active()
            ->findId($id)->asArray()->one();

        return  $this->viewMap($item);
    }

    /**
     * @param $items
     * @return array|void
     */
    private function viewMap($item)
    {
        if(empty($item)) return;
        $item['transport_id'] = $this->expItems($item, 'linkTransport');
        $item['driver_licence_id'] = $this->expItems($item, 'linkDrLic');
        $item['work_schedule_id'] = $this->expItems($item, 'linkWorkSchedule');
        $item['opport_id'] = $this->expItems($item, 'linkOpport');
        return $item;
    }

    /**
     * @param int $limit
     * @param null $offset
     * @return array|Vacancy[]
     */
    public function actionIndex($limit = 3, $offset = 0)
    {
        $model = Vacancy::find();

        $searchForm = new SearchForm();
        $searchForm->scenario = SearchForm::SCENARIO_VACANCY;
        if($searchForm->load(\Yii::$app->request->get(), '')) {
            $model = FilterTrait::searchParams($model, $searchForm);
        }
        $items  = $model->randItemsForHomePageApi($limit, $offset)->asArray()->all();
        return $this->itemsMap($items);
    }

    /**
     * @param $items
     * @return array|void
     */
    private function itemsMap($items)
    {
        if(empty($items)) return;
        $resumes = [];
        foreach ($items as $key => $item) {
            $resumes[$key] = $item;
            $resumes[$key]['transport_id'] = $this->expItems($item, 'linkTransport');
        }
        return $resumes;
    }

    private function expItems($items, $name)
    {
        $tr_id = [];
        if(!empty($items[$name])) {
            foreach ($items[$name] as $tr) {
                $tr_id[] = (int) $tr['id'];
            }
        }
        return $tr_id;
    }

    /**
     * @param $id
     * @return array
     * @throws HttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Vacancy::find()
            ->where(['id' => $id])
            ->andWhere(['user_id' => \Yii::$app->user->getId()])
            ->one();
        if($model) {
            return ['success' => $model->delete()];
        }
        throw new HttpException('404', 'Запись не найдена');
    }

    /**
     * Мои резюме
     * @return array|Vacancy[]
     */
    public function actionMy()
    {
        return Vacancy::find()
            ->withVacancy()
            ->where(['user_id' => \Yii::$app->user->getId()])
            ->asArray()
            ->all();
    }

    /**
     * смена статуса
     */
    public function actionStatus($id)
    {
        $model   = Vacancy::find()->findId($id)->one();
        if(!$model) return false;
        $model->status = $model->status == "1" ? "2" : "1";
        return $model->save();
    }
}