<?php
namespace backend\components;

use pheme\settings\Module;
use Yii;
use yii\base\Action;

class SettingsAction extends \pheme\settings\SettingsAction
{
    public $type = null;

    public function run()
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass();
        if ($this->scenario) {
            $model->setScenario($this->scenario);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            foreach ($model->toArray() as $key => $value) {
                Yii::$app->settings->set($key, $value, $model->formName(), $this->type);
            }
            Yii::$app->getSession()->addFlash('success',
                Module::t('settings', 'Настройки успещно сохранены {section}',
                    ['section' => $model->formName()]
                )
            );
            return Yii::$app->controller->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }
        foreach ($model->attributes() as $key) {
            $model->{$key} = Yii::$app->settings->get($key, $model->formName());
        }
        return $this->controller->render($this->viewName, ['model' => $model]);
    }
}
