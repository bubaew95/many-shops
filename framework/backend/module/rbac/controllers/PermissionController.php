<?php

namespace backend\module\rbac\controllers;

use yii\rbac\Item;
use backend\module\rbac\base\ItemController;

/**
 * Class PermissionController
 *
 * @package backend\module\rbac\controllers
 */
class PermissionController extends ItemController
{
    /**
     * @var int
     */
    protected $type = Item::TYPE_PERMISSION;

    /**
     * @var array
     */
    protected $labels = [
        'Item' => 'Permission',
        'Items' => 'Permissions',
    ];
}
