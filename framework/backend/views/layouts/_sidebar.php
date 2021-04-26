<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.01.2019
 * Time: 21:48
 */
use yii\widgets\Menu;
use yii\helpers\Url;

$get            = Yii::$app->request->get();

$controller     = Yii::$app->controller;
$controllerId   = $controller->id;
$moduleId       = $controller->module->id;
?>


<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <!-- div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/users/face17.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark"><?=Yii::$app->user->identity->email?></h6>
                    <span class="font-size-sm text-white text-shadow-dark">Santa Ana, CA</span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Мой аккаунт</span></a>
                </div>
            </div-->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="/admin/images/logo.png" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold"><?=Yii::$app->user->identity->name?></div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;<?=Yii::$app->user->identity->email ?>
                            </div>
                        </div>

                        <div class="ml-3 align-self-center sidebar-user-material-footer">
                            <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><i class="icon-cog3"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>Мой профиль</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['/site/logout'])?>" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Выйти</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">

            <?php
                $menus['main'] = [
                    'label' => 'Основные',
                    'url' => '',
                    'options'=>['class'=>'nav-item-header'],
                    'template' => '<div class="text-uppercase font-size-xs line-height-xs">{label}</div> <i class="icon-menu" title="Main"></i>',
                ];
                $menus['home'] = [
                    'label' => 'Главная',
                    'url' => Url::to(['/']),
                    'options'=>['class'=>'nav-item'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-home4"></i><span>{label}</span></a>',
                    'active' => $controller->id == 'site'
                ];

                $menus['users'] = [
                    'label' => 'Пользователи',
                    'url' => Url::to(['/users/index']),
                    'options'=>['class'=>'nav-item'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-users"></i><span>{label}</span></a>',
                    'active' => $controller->id == 'users'
                ];

                $menus['menu'] = [
                    'label' => 'Меню',
                    'url' => Url::to(['/menu/default']),
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-menu7"></i><span>{label}</span></a>',
                    'active' => $moduleId == 'menu'
                ];

                if(!empty($get['shop_id'])) :
                    $menus['pages'] = [
                        'label' => 'Страницы',
                        'url' => Url::to(['/page/index']),
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-pagebreak"></i><span>{label}</span></a>',
                        'active' => $controller->id == 'page'
                    ];

                    $menus['orders'] = [
                        'label' => 'Заказы',
                        'url' => Url::to(['/orders/default']),
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-cart2"></i><span>{label}</span></a>',
                        'active' => $moduleId == 'orders'
                    ];

                    $menus['attributes'] = [
                        'label' => 'Атрибуты',
                        'url' => Url::to(['/eav/default']),
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-chip"></i><span>{label}</span></a>',
                        'active' => $moduleId == 'eav'
                    ];

                    $menus['products'] = [
                        'label' => 'Товары',
                        'url' => Url::to(['/products/default']),
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-bag"></i><span>{label}</span></a>',
                        'active' => $moduleId == 'products'
                    ];
                else:
                    $menus['shops'] = [
                        'label' => 'Магазины',
                        'url' => Url::to(['/shops/default']),
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-store"></i><span>{label}</span></a>',
                        'active' => $moduleId == 'shops'
                    ];
                endif;

                if(Yii::$app->user->can(ADMIN_ROLE)) :
                    $menus['locations'] = [
                        'label' => 'Геолокация',
                        'url' => '#',
                        'options'=>['class'=>'nav-item nav-item-submenu'],
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-location4"></i><span>{label}</span></a>',
                        'items' => [
                            [
                                'label' => Yii::t('app', 'Regions'),
                                'url' => Url::to(['/locations/regions']),
                                'options'=>['class'=>'nav-item nav-item-submenu'],
                                'template' => '<a href="{url}" class="nav-link"><i class="icon-map4"></i><span>{label}</span></a>',
                                'active' => $moduleId == 'locations' && $controllerId == 'regions',
                            ],
                            [
                                'label' => Yii::t('app', 'City'),
                                'url' => Url::to(['/locations/city']),
                                'options'=>['class'=>'nav-item nav-item-submenu'],
                                'template' => '<a href="{url}" class="nav-link"><i class="icon-map5"></i><span>{label}</span></a>',
                                'active' => $moduleId == 'locations' && $controllerId == 'city',
                            ],
                        ]
                    ];

                    $menus['settings'] = [
                        'label' => 'Настройки',
                        'url' => '#',
                        'options'=>['class'=>'nav-item nav-item-submenu'],
                        'template' => '<a href="{url}" class="nav-link"><i class="icon-equalizer2"></i><span>{label}</span></a>',
                        'items' => [
                            [
                                'label' => 'Роли',
                                'url' => '#',
                                'options'=>['class'=>'nav-item nav-item-submenu'],
                                'template' => '<a href="{url}" class="nav-link"><i class="icon-equalizer2"></i><span>{label}</span></a>',
                                'items' => [
                                    [
                                        'label' => Yii::t('yii2mod.rbac', 'Roles'),
                                        'url' => Url::to(['/rbac/role']),
                                        'options'=>['class'=>'nav-item nav-item-submenu'],
                                        'template' => '<a href="{url}" class="nav-link"><i class="icon-git"></i><span>{label}</span></a>',
                                        'active' => $moduleId == 'rbac' && $controllerId == 'role',
                                    ],
                                    [
                                        'label' => Yii::t('yii2mod.rbac', 'Permissions'),
                                        'url' => Url::to(['/rbac/permission']),
                                        'options'=>['class'=>'nav-item nav-item-submenu'],
                                        'template' => '<a href="{url}" class="nav-link"><i class="icon-git"></i><span>{label}</span></a>',
                                        'active' => $moduleId == 'rbac' && $controllerId == 'permission',
                                    ],
                                    [
                                        'label' => Yii::t('yii2mod.rbac', 'Assignments'),
                                        'url' => Url::to(['/rbac/assignment']),
                                        'options'=>['class'=>'nav-item nav-item-submenu'],
                                        'template' => '<a href="{url}" class="nav-link"><i class="icon-git"></i><span>{label}</span></a>',
                                        'active' => $moduleId == 'rbac' && $controllerId == 'assignment',
                                    ],
                                    [
                                        'label' => Yii::t('yii2mod.rbac', 'Routes'),
                                        'url' => Url::to(['/rbac/route']),
                                        'options'=>['class'=>'nav-item nav-item-submenu'],
                                        'template' => '<a href="{url}" class="nav-link"><i class="icon-git"></i><span>{label}</span></a>',
                                        'active' => $moduleId == 'rbac' && $controllerId == 'route',
                                    ],
                                ]
                            ],
                            [
                                'label' => 'Системные настройки',
                                'url' => Url::to(['/settings/index']),
                                'options'=>['class'=>'nav-item nav-item-submenu'],
                                'template' => '<a href="{url}" class="nav-link"><i class="icon-cogs"></i><span>{label}</span></a>',
                            ]
                        ]
                    ];
                endif;

				echo \yii\widgets\Menu::widget([
					'items' => $menus,

					'activateParents' => true,
					'activeCssClass' => "nav-item-open",
					'itemOptions' => [ 'class' => 'nav-item nav-item-submenu'],
					'submenuTemplate' => "\n<ul class='nav nav-group-sub' data-submenu-title='Layouts'>\n{items}\n</ul>\n",
					'options' => [
						'id'=>'navid',
						'class' => 'nav nav-sidebar',
						'data-nav-type'=>'accordion',
					]
				]);

                //echo \backend\components\widgets\MenuWidget::widget(['menus' => $menus]);
            ?>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
