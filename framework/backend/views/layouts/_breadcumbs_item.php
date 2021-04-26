<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.01.2019
 * Time: 22:13
 */

$items = [];
if($this->params['breadcrumbs']) {
    foreach ($this->params['breadcrumbs'] as $item) {
        if(is_array($item)) {
            $items[] = $item;
        } else {
            $items[] = strip_tags($item);
        }
    }
}

echo \yii\widgets\Breadcrumbs::widget([
    'itemTemplate' => "<span class='breadcrumb-item'>{link}</span>\n", // template for all links
    'tag' => "div",
    'view' => "_breadcumbs_item",
    'activeItemTemplate' => '<span class="breadcrumb-item active">{link}</span>',
    'options'=>[
        'class'=>'breadcrumb'
    ],
    'homeLink'=>[
        'label' => '<i class="icon-home2 mr-2"></i>',
        'url' => ['post-category/view', 'id' => 10],
        'class' => 'breadcrumb-item',
        'encode' => false,

        'template' => "<li><b>{link}</b></li>\n", // template for this link only
    ],
    'links' => $items,
]);
