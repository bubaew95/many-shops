<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 12.04.2020
 * Time: 0:34
 */

namespace common\components;

use yii\helpers\Html;

class Modal extends \yii\bootstrap\Modal
{

    protected function renderHeader()
    {
        $button = $this->renderCloseButton();
        if ($button !== null) {
            $this->header = "{$this->header}\n{$button}";
        }
        if ($this->header !== null) {
            Html::addCssClass($this->headerOptions, ['widget' => 'modal-header']);
            return Html::tag('div', "\n" . $this->header . "\n", $this->headerOptions);
        } else {
            return null;
        }
    }


}