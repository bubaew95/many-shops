<?php

namespace frontend\widgets;

use frontend\models\forms\SearchForm;
use yii\base\Widget;

class SearchWidget extends Widget
{

    public function init()
    {
    }

    public function run()
    {
        $model = new SearchForm();
        return $this->render('search', [
            'model' => $model,
        ]);
    }

}