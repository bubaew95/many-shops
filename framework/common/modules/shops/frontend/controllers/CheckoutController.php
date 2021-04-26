<?php


namespace common\modules\shops\frontend\controllers;



use common\models\orders\Orders;
use common\modules\shops\models\forms\CheckoutForm;
use yii\helpers\Url;

class CheckoutController extends \frontend\controllers\BaseController
{

    public function actionIndex()
    {
        $model = CheckoutForm::getModel();
        $requestPost = \Yii::$app->request->post();

        if(isset($requestPost['CheckoutForm']['is_create_account'])) {
            $model->scenario = CheckoutForm::SCENARIO_REGISTER;
        }else {
            $model->scenario = CheckoutForm::SCENARIO_DEFAULT;
        }

        if($model->load($requestPost)) {
            $order_id = $model->save();
            if($order_id) return $this->redirect(Url::to(['checkout/finish', 'order_id' => $order_id]));
            $this->errors = $model->errors;
        }

        return $this->render('index', [
            'model' => $model,
            'errors' => $this->errors
        ]);
    }

    public function actionFinish($order_id)
    {
        $model = Orders::findOne($order_id);
        return $this->render('finish', compact('model'));
    }

}