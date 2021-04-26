<?php
namespace frontend\widgets\header;

use kartik\base\Widget;

class HeaderWidget extends Widget
{
    public $settings = [];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('index', [
            'settings' => $this->settings
        ]);
    }

}