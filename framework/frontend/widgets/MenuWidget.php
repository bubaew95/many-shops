<?php

namespace frontend\widgets;

use common\models\menu\Menu;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $model = [];
    public $items = [];

    public function init()
    {
        $cache = \Yii::$app->cache;
        $getMenu = $cache->get('menu');

        if ($getMenu === false) {
            $this->model = Menu::find()->with(['page'])->asArray()->all();
            $cache->set('menu', $this->model);
        } else {
            $this->model = $getMenu;
        }
    }

    public function run()
    {
        return $this->render('menu', [
            'model'     => $this->model,
            'items'     => $this->items
        ]);
    }

}