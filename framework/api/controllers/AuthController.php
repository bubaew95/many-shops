<?php


namespace api\controllers;


use api\models\LoginForm;
use common\models\forms\RegistrationIndForm;
use common\models\forms\RegistrationLegForm;
use common\models\user\User;
use frontend\models\PasswordResetRequestForm;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'login' => ['POST'],
                'reg' => ['POST'],
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return [
                'id' => Yii::$app->user->identity->getId(),
                'status' => 200,
                'access_token' => Yii::$app->user->identity->getAuthKey()
            ];
        }
        throw new UnauthorizedHttpException('Your request was made with invalid credentials.', 401);
    }

    /**
     * Страница регистрации
     * @param null $type
     * @return string|\yii\web\Response
     * @throws HttpException
     */
    public function actionReg($type = null)
    {
        if($type == 1) {
            return $this->registrationInd();
        }

        if($type == 2) {
            return $this->registrationLeg();
        }

        throw new HttpException('404', 'Страница не найдено');
    }

    /**
     * Регистрация Физ.Лиц
     * @return string|\yii\web\Response
     */
    private function registrationInd()
    {
        $model = new RegistrationIndForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        return $model->save() ? ['status' => 200] : $model->errors;
    }

    /**
     * Регистрация юр.лиц
     * @return string|\yii\web\Response
     */
    private function registrationLeg()
    {
        $model = new RegistrationLegForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        return $model->save() ? ['status' => 200] : $model->errors;
    }

    /**
     * @return array|int[]
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        return $model->sendEmail() ? ['status' => 200] : $model->errors;
    }

}