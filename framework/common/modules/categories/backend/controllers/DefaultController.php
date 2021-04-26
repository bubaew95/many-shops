<?php

namespace common\modules\categories\backend\controllers;

use backend\controllers\BaseController;
use common\models\categories\CategoriesToShop;
use Yii;
use common\models\categories\Category;
use common\modules\categories\models\CategorySearchModel;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Category model.
 */
class DefaultController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param int $id
     * @param int $shop_id
     * @return bool[]|string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdatecategory(int $id, int $shop_id)
    {
        $modelRename = $this->findModel($id);
        $model       = CategoriesToShop::find()->where(['category_id' => $id])->one();
        if(!$model) {
            $model = new CategoriesToShop();
            $model->category_id = $id;
            $model->shop_id = $shop_id;
        } else {
            $deleteModel = clone $model;
        }

        if($model->load(Yii::$app->request->post())) {
            if(empty($model->title) && $model->active) {
                $deleteModel->delete();
            }
            $model->save();
            return $this->redirect(['index']);
        }

        if(!$model) {
            $model->title = $modelRename->title;
        }

        return $this->render('update', [
            'model' => $model,
            'isShopMenuRename' => true
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ( $model->load(Yii::$app->request->post()))
        {
            $post      = Yii::$app->request->post('Category');
            $parent_id = $post['parentId'];

            if (empty($parent_id)) $model->makeRoot();
            else {
                $parent = Category::findOne($parent_id);
                $model->appendTo($parent);
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()))
        {
            $post      = Yii::$app->request->post('Category');
            $parent_id = $post['parentId'];

            if ($model->save()) {
                if (empty($parent_id)) {
                    if ( !$model->isRoot() ) $model->makeRoot();
                } else { // move node to other root
                    if ($model->id != $parent_id) {
                        $parent = Category::findOne($parent_id);
                        $model->appendTo($parent);
                    }
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->isRoot())
            $model->deleteWithChildren();
        else
            $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
