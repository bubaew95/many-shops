<?php

namespace backend\components;

use yii\web\HttpException;
use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRule;
use yii\web\UrlRuleInterface;

class AnyParamsRule extends UrlRule implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        $get = \Yii::$app->request->get();
        $url = null;
        if(!empty($get['shop_id'])) {
            $url = !empty($route) ? "{$get['shop_id']}/{$route}" : $get['shop_id'];

            $queryParams = !empty($params) ? "?" . http_build_query($params) : null;

            return "{$url}{$queryParams}";
        }
        return false;
    }

    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        return false; //(Примечание 4)
    }

}