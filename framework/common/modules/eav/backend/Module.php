<?php

namespace common\modules\eav\backend;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\eav\backend\controllers';

    public $defaultRoute = 'default';

    public function init()
    {
        parent::init();

        $this->setModule('admin', 'common\modules\eav\backend\admin\Module');
        $this->registerTranslations();
    }

    public function createController($route)
    {

        if (strpos($route, 'admin/') !== false) {
            return $this->getModule('admin')->createController(str_replace('admin/', '', $route));
        } else {
            return parent::createController($route);
        }

    }
    
    public function registerTranslations()
        {
            Yii::$app->i18n->translations['eav'] = 
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@common/modules/eav/backend/messages",
                'forceTranslation' => true
            ];
        }
}
