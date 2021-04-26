<?php
namespace frontend\controllers;

use common\models\pages\Pages;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class PageController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($alias)
    {
        $model = Pages::find()->active()->where(['alias' => $alias])->one();
        if(!$model){
            throw new BadRequestHttpException('Страница не найдена.', '404');
        }
        return $this->render('index', compact('model'));
    }
}
