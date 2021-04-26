<?php
use \common\modules\categories\components\Menu;
use common\modules\categories\components\MenuItems;
?>
<div class="d-none d-xl-block container">
    <div class="row">
        <!-- Secondary Menu -->
        <div class="col">
            <!-- Nav -->
            <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                <!-- Navigation -->
                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">

                    <?php
                        MenuItems::$urlTemplate = '/menu/category';
                        //MenuItems::$subTemplate = '<a href="{url}" class="nav-link u-header__sub-menu-nav-link">{label}</a>';
                        echo Menu::widget([
                            'items' => MenuItems::getFullTreeStructure(['block' => 'top']),
                            'itemOptions' =>  [
                                'class' => 'nav-item hs-has-mega-menu u-header__nav-item',
                                'data-event' => "click",
                                'data-animation-in' => "slideInUp",
                                'data-animation-out' => "fadeOut",
                                'data-position' => "left",
                            ],
                            'activateParents' => true,
                            'activeCssClass' => "active",
                            'linkTemplate' => [
                                'class' => 'nav-link u-header__nav-link',
                                'id' => 'megaMenuShop-{id}',
                                'aria-haspopup' => 'true',
                                'aria-expanded' => 'false',
                            ],
                            'submenuTemplate' => '
                                <ul class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="megaMenuShop-{id}">
                                {items} 
                                </ul>
                            ',
                            'options' => [
                                'class' => 'navbar-nav u-header__navbar-nav m-0',
                            ]
                        ])
                    ?>

                </div>
                <!-- End Navigation -->
            </nav>
            <!-- End Nav -->
        </div>
        <!-- End Secondary Menu -->
    </div>
</div>

