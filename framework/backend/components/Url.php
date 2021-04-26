<?php


namespace backend\components;


use yii\helpers\BaseUrl;

class Url extends BaseUrl
{
    public static function to($url = '', $scheme = false, $showParams = true){
        $get = \Yii::$app->request->get();
        if(!empty($get['shop_id'])) {
            $url = array_merge($url, ['shop_id' => $get['shop_id']]);
        }
        return parent::to($url, $scheme);
    }
}