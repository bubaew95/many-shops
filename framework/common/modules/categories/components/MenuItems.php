<?php

namespace common\modules\categories\components;

use common\models\categories\Category;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;


class MenuItems extends Widget
{

    public static $urlTemplate = '/catalog/default/index';
    public static $sort = 'tree, lft';

    /**
     *
        MenuItems::$options = [
            'class' => 'nav-item hs-has-mega-menu u-header__nav-item',
            'data-event' => "click",
            'data-animation-in' => "slideInUp",
            'data-animation-out' => "fadeOut",
            'data-position' => "left",
        ];
     *
     * @var array
     */
    public static $options = [];

    /**
        MenuItems::$template = [
            'class' => 'nav-link u-header__nav-link',
            'id' => 'megaMenuShop-{id}',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false',
        ];
     * @var null
     */
    public static $template = null;

    /**
        MenuItems::$subTemplate = '<a href="{url}" class="nav-link u-header__sub-menu-nav-link">{label}</a>';
     * @var null
     */
    public static $subTemplate = null;


    public static function getTree($categories, $alias = null, $left = 0, $right = null, $lvl = 1)
    {
        $tree = [];

        foreach ($categories as $index => $category) {
            if ($category->lft >= $left + 1 && (is_null($right) || $category->rgt <= $right) && $category->depth == $lvl) {
                $tree[$index] = [
                    'id' => $category->id,
                    'label' => $category->title,
                    'url' => Url::to([self::$urlTemplate, 'alias' => $category->alias]),
                    'items' => self::getTree($categories, $alias, $category->lft, $category->rgt, $category->depth + 1),
                ];

                if(!is_null(self::$subTemplate)) {
                    $tree[$index]['template'] = self::$subTemplate;
                }
            }
        }
        return $tree;
    }

    /**
     * @param bool $isRoot
     * @return array
     */
    public static function getFullTreeStructure($where = null)
    {
        $roots = Category::find();
        if($where) $roots->where($where);
        $roots = $roots->roots()->addOrderBy(self::$sort)->all();

        $tree = [];
        foreach ($roots as $root) {
            $childrens = $root->children()->all();

            //TODO:: Поправить url
            $letItem = [
                'id'        => $root->id,
                'label'     => $root->title,
                'url'       => $root->alias === '/' ? '/' : Url::to([self::$urlTemplate, 'alias' => $root->alias]),
                'items'     => self::getTree($childrens, $root->alias),
                'options'   => self::$options,
                'isItems'   => count($childrens) > 0,
            ];

            if(!is_null(self::$template)) {
                $letItem['template'] = self::$template;
            }

            $tree [] = $letItem;
        }
        return $tree;
    }

    /**
     * @param int $category_id
     * @return array
     */
    public static function getShopsCategory(int $category_id)
    {
        $roots = Category::find()->roots()->addOrderBy(self::$sort)
            ->joinWith('categoryToShop')
            ->where(['tree' => $category_id])
            ->andWhere(['depth' => 1])
            ->all();

        $tree = [];
        foreach ($roots as $root) {
            $tree [] = [
                'id' => $root->id,
                'label' => $root->categoryToShop->title ?? $root->title,
                'url' => Url::to([self::$urlTemplate, 'alias' => $root->alias]),
            ];
        }
        return $tree;
    }

    /**
     * @return array
     */
    public static function selectMenuItems()
    {
        if(Yii::$app->shopComponent->catId > 0) {
            return self::getShopsCategory(
                 Yii::$app->shopComponent->catId
            );
        }
        return self::getFullTreeStructure();
    }
}