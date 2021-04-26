<?php

namespace backend\module\locations\controllers;

use backend\controllers\BaseController;
use backend\module\rbac\filters\AccessControl;
use Yii;
use common\models\geo\GeoCity;
use backend\module\locations\models\GeoCitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CityController implements the CRUD actions for GeoCity model.
 */
class CityController extends BaseController
{
//    public function behaviors(): array
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => [ADMIN_ROLE]
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all GeoCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeoCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeoCity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderView('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GeoCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeoCity();

        if ($model->load(Yii::$app->request->post())) {
            return $this->save($model);
        }

        return $this->renderView('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GeoCity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            return $this->save($model);
        }

        return $this->renderView('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return array|GeoCity[]
     */
    public function actionJson(int $id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return GeoCity::find()->where(['region_id' => $id])->asArray()->all();
    }

    /**
     * Deletes an existing GeoCity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GeoCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeoCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeoCity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
