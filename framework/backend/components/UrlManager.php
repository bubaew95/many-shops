<?php


namespace backend\components;


class UrlManager extends \yii\web\UrlManager
{
    public function createUrl($params, $showParams=true)
    {
        $url = parent::createUrl($params);

        if($showParams){
            $url = str_replace(['?', '=', '&'], '/', $url);
        }else{
            $data = explode('?', $url);
            if(isset($data[1])){
                preg_match_all('/\=(.*?)(?:&|$)/', $data[1], $matches);
                $url = $data[0].'/'.implode('/', $matches[1]);
            }
        }

        return $url;
    }
}