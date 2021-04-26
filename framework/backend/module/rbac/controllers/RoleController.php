<?php

namespace backend\module\rbac\controllers;

use yii\rbac\Item;
use backend\module\rbac\base\ItemController;

/**
 * Class RoleController
 *
 * @package backend\module\rbac\controllers
 */
class RoleController extends ItemController
{
    /**
     * @var int
     */
    protected $type = Item::TYPE_ROLE;

    /**
     * @var array
     */
    protected $labels = [
        'Item' => 'Role',
        'Items' => 'Roles',
    ];
}
