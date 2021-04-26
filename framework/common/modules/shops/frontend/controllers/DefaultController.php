<?php

namespace common\modules\shops\frontend\controllers;

use common\models\shops\Shops;
use frontend\controllers\BaseController;
use yii\web\Controller;

/**
 * Default controller for the `shops` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = Shops::find()->active()->all();
        return $this->render('index', compact('model'));
    }
}
