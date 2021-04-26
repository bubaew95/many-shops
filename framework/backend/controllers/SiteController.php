<?php
namespace backend\controllers;

use backend\models\forms\LoginForm;
use common\models\adv\Resume;
use common\models\adv\Vacancy;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            //Свои настройки
        ]);
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index' );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionInfo()
    {
        return $this->render('info' );
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
