<?php

use common\modules\categories\components\MenuItems;
use common\modules\categories\components\Menu;
use yii\helpers\Url;

MenuItems::$urlTemplate = '/menu/category';
?>
<div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">

    <?= Menu::widget([
            'items' => MenuItems::getFullTreeStructure(['block' => 'top']),
            'activateParents' => true,
            'activeCssClass' => "active",
            'itemOptions' =>  [
                'class' => 'nav-item hs-has-mega-menu u-header__nav-item',
                'data-event' => "hover",
                'data-animation-in' => "slideInUp",
                'data-animation-out' => "fadeOut",
                'data-position' => "left",
            ],
            'linkTemplate' => [
                'class' => 'nav-link u-header__nav-link',
                'id' => 'megaMenu-{id}',
                'aria-haspopup' => 'true',
                'aria-expanded' => 'false',
            ],
            'submenuTemplate' => "<ul class='hs-mega-menu w-100 u-header__sub-menu'>{items}</ul>",
            'options' => [
                'class' => 'navbar-nav u-header__navbar-nav',
            ]
        ])
    ?>

</div>