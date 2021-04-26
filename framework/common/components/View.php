<?php

namespace common\components;

use yii\helpers\Html;

class View extends \yii\web\View
{
    /**
     * @var string Content that should be injected to end of `<head>` tag
     */
    public $injectToHead    = '';

    /**
     * @var string Content that should be injected to end of `<body>` tag
     */
    public $injectToBodyEnd = '';

    /**
     * @inheritdoc
     */
    protected function renderHeadHtml()
    {
        return parent::renderHeadHtml() . $this->injectToHead;
    }

    /**
     * @inheritdoc
     */
    protected function renderBodyEndHtml($ajaxMode)
    {
        return parent::renderBodyEndHtml($ajaxMode) . $this->injectToBodyEnd;
    }
}