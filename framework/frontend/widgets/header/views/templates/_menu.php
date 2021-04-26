<?= \common\modules\categories\components\Menu::widget([
    'allCategories' => \common\models\categories\Category::getTreeObject(),
    'beginDepth' => 0,
    'options' => [
        'main' => [
            'ul' => ['class' => 'navbar-nav u-header__navbar-nav border-primary border-top-0'],
            'lonely' => [ //Категрия одиночка
                'li' => [
                    'class' => 'nav-item u-header__nav-item',
                    'data-event' => 'hover',
                    'data-position' => 'left'
                ],
                'a' => ['class' => 'nav-link u-header__nav-link font-weight-bold'],
            ],
            'hasNesting' => [ //Категория с дочерними категориями
                'li' => [
                    'class' => 'nav-item hs-has-mega-menu u-header__nav-item'
                ],
                'a' => [
                    'class' => 'nav-link u-header__nav-link u-header__nav-link-toggle',
                    'aria-haspopup' => "true",
                    'aria-expanded' => "false"
                ],
            ],
            'active' => [
                'li' => ['class' => 'active'],
                'a' => [ 'class' => 'maybe-necessary-a-instead-of-li', ]
            ],
        ],
        'nested' => [
            'ul' => [
                'class' => 'hs-mega-menu vmm-tfw u-header__sub-menu animated hs-position-left fadeOut',
                'aria-labelledby' => "basicMegaMenu",
                'style' => "display: none;"
            ],
            'lonely' => [
                'li' => ['class' => ''],
                'a' => ['class' => 'nav-link u-header__sub-menu-nav-link'],
            ],
            'hasNesting' => [
                'li' => ['class' => ''],
                'a' => ['class' => 'nav-link u-header__sub-menu-nav-link'],
            ],
            'active' => [
                'li' => ['class' => 'active'],
                'a' => [
                    'class' => 'maybe-necessary-a-instead-of-li',
                ]
            ],
        ],
    ]
])?>