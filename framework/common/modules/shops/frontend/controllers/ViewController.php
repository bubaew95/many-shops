<?php

namespace common\modules\shops\frontend\controllers;

use frontend\controllers\BaseController;
use yii\web\Controller;

/**
 * Default controller for the `shops` module
 */
class ViewController extends BaseController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
