<?php


namespace frontend\controllers;


use common\models\forms\LoginForm;
use common\models\forms\RegistrationIndForm;
use common\models\forms\RegistrationLegForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use Yii;

class AuthController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => ['login', 'registration', 'personal-type', 'request-password-reset', 'reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Страница авторизации
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', compact('model'));
    }

    /**
     * Страница регистрации
     * @param null $type
     * @return string|\yii\web\Response
     * @throws HttpException
     */
    public function actionRegistration($type = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/auth/login');
        } else {
            $model->password = '';
            $model->repassword = '';
        }

        return $this->render(
            'registration-ind',
            compact('model')
        );
    }

    /**
     * Регистрация юр.лиц
     * @return string|\yii\web\Response
     */
    private function registrationLeg()
    {
        $model = new RegistrationLegForm();

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/auth/login');
        } else {
            $model->password = '';
            $model->repassword = '';
        }

        return $this->render('registration-leg', compact('model'));
    }

    /**
     * Страница выбора типа регистрации
     * @return string
     */
    public function actionPersonalType()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('personal-type');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'На ваш почтовый ящик было отправлено письмо с инструкцией.');
                return $this->redirect(['auth/login']);
            } else {
                Yii::$app->session->setFlash('error', 'Приносим свои извенения, мы не смогли отправить письмо на указанный электронный адрес');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->redirect(['auth/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}