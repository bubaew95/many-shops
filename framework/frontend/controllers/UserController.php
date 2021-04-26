<?php
namespace frontend\controllers;

use common\models\adv\Resume;
use common\models\adv\Vacancy;
use common\models\forms\RegistrationIndForm;
use common\models\forms\RegistrationLegForm;
use common\models\user\User;
use common\traits\HelperTrait;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Site controller
 */
class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => ['favorites', 'index', 'resume', 'vacancy'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['edit'],
                        'allow' => true,
                    ]
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $userModel = User::find()->where(['id' => Yii::$app->user->getId()])->one();
        return $userModel->type == 1
            ? $this->userInd($userModel)
            : $this->userLeg($userModel);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionEdit($token)
    {
        if(empty($token))
            throw new HttpException(403, 'Your request was made with invalid credentials.');

        Yii::$app->params['isMobile'] = true;
        $userModel = User::find()->where(['auth_key' => $token])->one();

        if($userModel === null)
            throw new HttpException(404, 'Model is empty');

        Yii::$app->user->login( $userModel, 0 );

        return $userModel->type == 1
            ? $this->userInd($userModel, $token)
            : $this->userLeg($userModel, $token);
    }

    /**
     * @param User $model
     * @return string|\yii\web\Response
     */
    private function userInd(User $model, $token = 0)
    {
        $userModelInd           = $model->ind;
        $formModel              = new RegistrationIndForm();
        $formModel->scenario    = RegistrationIndForm::SCENARIO_UPDATE;
        $formModel->phone       = $model->phone;
        $formModel->email       = $model->email;
        $formModel->image       = $model->image;
        $formModel->firstname   = $userModelInd->firstname;
        $formModel->name        = $userModelInd->name;
        $formModel->lastname    = $userModelInd->lastname;
        $formModel->birthday    = $userModelInd->birthday;
        $formModel->password    = '';
        $formModel->repassword  = '';

        if ($formModel->load(Yii::$app->request->post()) && $formModel->updateUser($model, $userModelInd))  {
            return $this->redirect(empty($token) ? Url::to([ 'user/index']) : Url::to(['user/edit', 'token' => $token] ));
        }

        return $this->render(
            'index',
            [
                'model'     => $formModel,
                'action'    => 'index/form_ind',
                'title'     => 'Личный кабинет',
            ]
        );
    }

    /**
     * Редактирование физ.лица
     * @param User $model
     * @return string|\yii\web\Response
     */
    private function userLeg(User $model, $isMobile = 0)
    {
        $userModelLeg           = $model->leg;
        $formModel              = new RegistrationLegForm();
        $formModel->scenario    = RegistrationLegForm::SCENARIO_UPDATE;
        $formModel->phone       = $model->phone;
        $formModel->email       = $model->email;
        $formModel->image       = $model->image;
        $formModel->org_name    = $userModelLeg->org_name;
        $formModel->inn         = $userModelLeg->inn;
        $formModel->password    = '';
        $formModel->repassword  = '';

        if ($formModel->load(Yii::$app->request->post()) && $formModel->updateUser($model, $userModelLeg))  {
            return $this->redirect(empty($token) ? Url::to([ 'user/index']) : Url::to(['user/edit', 'token' => $token] ));
        }

        return $this->render(
            'index',
            [
                'model'     => $formModel,
                'action'    => 'index/form_leg',
                'title'     => 'Личный кабинет',
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionResume($id = null, $event = null)
    {
        $model = Resume::find()->active();

        $model->where([
            'user_id' => Yii::$app->user->getId()
        ]);

        if($event && $event == 'delete') {
            $model->andWhere([Resume::tableName() . '.id' => $id]);
            if($model->one()->delete()) {
                return $this->redirect(Url::to(['user/resume']));
            }
        }

        if($id) {
            $model->andWhere([Resume::tableName() . '.id' => $id]);
            return $this->resumeUpdate($model->one());
        }

        return $this->resumeList($model);
    }

    /**
     * @param Resume $model
     * @return string
     */
    private function resumeList($model)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        return $this->render(
            'action',
            [
                'model' => $dataProvider,
                'action' => 'resume/index',
                'title' => 'Мои резюме',
            ]
        );
    }

    /**
     * Редактирование резюме
     * @param $model
     * @return string|\yii\web\Response
     */
    private function resumeUpdate($model)
    {
        if($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Резюме успешно отредактировано');
                return $this->redirect(Url::to(['user/resume']));
            }

            if($model->errors) {
                HelperTrait::viewErrorsSessionFlash($model->errors);
            }
        }

        return $this->render(
            'action',
            [
                'model' => $model,
                'action' => 'resume/update',
                'title' => 'Редактирование резюме',
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionVacancy($id = null, $event = null)
    {
        $model = Vacancy::find()->active();

        $model->where([
            'user_id' => Yii::$app->user->getId()
        ]);

        if($event && $event == 'delete') {
            $model->andWhere([Vacancy::tableName() . '.id' => $id]);
            if($model->one()->delete()) {
                return $this->redirect(Url::to(['user/vacancy']));
            }
        }

        if($id) {
            $model->andWhere([Vacancy::tableName() . '.id' => $id]);
            return $this->vacancyUpdate($model->one());
        }

        return $this->vacancyList($model);
    }

    /**
     * @param Resume $model
     * @return string
     */
    private function vacancyList($model)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        return $this->render(
            'action',
            [
                'model' => $dataProvider,
                'action' => 'vacancy/index',
                'title' => 'Мои вакансии',
            ]
        );
    }

    /**
     * Редактирование резюме
     * @param $model
     * @return string|\yii\web\Response
     */
    private function vacancyUpdate($model)
    {
        if($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Вакансия успешно отредактировано');
                return $this->redirect(Url::to(['user/vacancy']));
            }

            if($model->errors) {
                HelperTrait::viewErrorsSessionFlash($model->errors);
            }
        }

        return $this->render(
            'action',
            [
                'model' => $model,
                'action' => 'vacancy/update',
                'title' => 'Редактирование вакансии',
            ]
        );
    }

    public function actionFavorites()
    {
        $modelResume      = Resume::find()->active()->with('user', 'userInd', 'userLeg')->joinWith('favorite');
        $modelResumeCount = $modelResume->count();
        $modelResume      = $modelResume->all();

        $modelVakancy      = Vacancy::find()->active()->with('user', 'userInd', 'userLeg')->joinWith('favorite');
        $modelVakancyCount = $modelVakancy->count();
        $modelVakancy      = $modelVakancy->all();

        return $this->render('favorites', compact(
            'modelResume', 'modelResumeCount',
            'modelVakancy', 'modelVakancyCount'
        ));
    }
}
