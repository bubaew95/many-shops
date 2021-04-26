<?php
namespace backend\controllers;

use backend\models\forms\LoginForm;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SettingsController extends BaseController
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
    public function actions()
    {
        return [
            'index' => [
                'class'      => 'backend\components\SettingsAction',
                'modelClass' => 'backend\models\settings\Site',
                'type'       => 'string',
                'viewName'   => 'index'	// The form we need to render
            ],
        ];
    }

    public function actionClearSettingsCache()
    {
        Yii::$app->settings->clearCache();
        return $this->redirect();
    }

    public function actionClearCache()
    {
        Yii::$app->cache->flush();
        return $this->redirect();
    }
}
