<?php

namespace common\modules\categories\components;

use Exception;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Это расширение является виджетом для yii2. Используется для реализации динамической системы пунктов меню.
 * Выводит список пунктов меню используя дерево каталогов Nested Set. Формирование происходит средствами PHP
 * без дополнительных запросов к базе данных. Вложенность не ограничена. Подходит для любых шаблонов, есть возможность
 * указать любые параметры для всех тегов.
 */
class Menu extends Widget
{
    /**
     * @var $allCategories array который должен содержать выборку в виде объектов из базы данных
     * в которой лежат пункты меню. Обязательные поля в таблице: `id`, `lft`, `rgt`, `lvl`, `title`, `url`.
     * Поле `url` должно содержать относительный путь. Полный путь будет сформирован.
     */
    public $allCategories;

    /**
     * @var $beginDepth int уровень вложенности, с которой начинается построения пунктов меню.
     */
    public $beginDepth = 1;

    /**
     * @var $options array который содержит все параметры для тегов.
     * Передавать можно как `class`, так и любые атрибуты тега.
     * Если ваше меню не будет иметь вложенность, то параметр `nested` нет необходимости указывать.
     * ПРИМЕР:
     *
     *  'options' => [
     *      'main' => [
     *          'ul' => ['class' => 'navbar-nav mr-auto', 'style' => 'margin-top: 20px'],
     *          'lonely' => [
     *              'li' => ['class' => 'nav-item'],
     *              'a' => ['class' => 'nav-link'],
     *          ],
     *          'hasNesting' => [
     *              'li' => ['class' => 'nav-item dropdown'],
     *              'a' => ['class' => 'nav-link dropdown-toggle'],
     *              'icon' => 'fa fa-arrow-bottom'
     *          ],
     *          'active' => [
     *              'li' => ['class' => 'active'],
     *              'a' => ['class' => 'maybe-necessary-a-instead-of-li',
     *          ],
     *      ],
     *      'nested' => [
     *          'ul' => ['class' => 'dropdown-menu', 'data-toggle' => 'example'],
     *          'lonely' => [
     *              'li' => ['class' => 'dropdown-item'],
     *              'a' => ['class' => 'dropdown-link'],
     *          ],
     *          'hasNesting' => [
     *              'li' => ['class' => 'dropdown-item dropdown'],
     *              'a' => ['class' => 'dropdown-link dropdown'],
     *              'icon' => 'fa fa-arrow-right'
     *          ],
     *          'active' => [
     *              'li' => ['class' => 'active'],
     *              'a' => ['class' => 'maybe-necessary-a-instead-of-li',
     *          ],
     *      ],
     *  ],
     *
     * `main` - меню первого уровня, не вложенный в какие-либо категории.
     * `nested` - меню второго или ниже уровня, вложенное.
     *
     * `lonely` - пункт меню, который НЕ имеет вложенных в него категорий.
     * `hasNesting` - пункт меню, который имеет вложенные в него категории.
     *
     * `active` - указываем дополнительные параметры для активного пункта меню, которые применятся к тегу `li` и `a`.
     * Основные параметры наследуются.
     *
     * Параметры для `ul`, `li`, `a`, `active` передаются массивом.
     * Параметры для `icon` передаются строкой.
     *
     */
    public $options = [];

    /**
     * Вывод пунктов меню.
     */
    public function run()
    {
        if ($this->allCategories[0]->depth != $this->beginDepth) {
            throw new Exception('Уровень вложенности первого элемента "lvl" не совпадает с "beginLvl".');
        }
        echo Html::beginTag('ul', $this->ul('main')) . PHP_EOL;
        echo $this->createList($this->allCategories, $this->beginDepth);
        echo Html::endTag('ul') . PHP_EOL;
    }

    /**
     * Создание списка из категорий.
     *
     * @param $categories array категорий из которых необходимо построить список
     * @param $depth integer указывающее уровень вложенности
     */
    private function createList($categories, $depth)
    {
        foreach ($categories as $category) {
            if ($category->depth == $depth) {
                echo Html::beginTag('li', $this->optionsTag($this->allCategories, $category, 'li'));
                echo Html::tag(
                    'a',
                    $category->title . $this->icon($category),
                    $this->optionsTag($this->allCategories, $category, 'a')
                );
                if ($category->lft + 1 != $category->rgt) {
                    echo PHP_EOL . Html::beginTag('div', $this->ul('nested')) . PHP_EOL;
                    echo PHP_EOL . Html::beginTag('div', ['class' => 'row u-header__mega-menu-wrapper']) . PHP_EOL;
                    echo PHP_EOL . Html::beginTag('div', ['class' => 'col mb-3 mb-sm-0']) . PHP_EOL;
                    echo PHP_EOL . Html::tag('span', $category->title, ['class' => 'u-header__sub-menu-title']);

                    echo PHP_EOL . Html::beginTag('ul', ['class' => 'u-header__sub-menu-nav-group']) . PHP_EOL;
                    $children = $this->childCategories($categories, $category->lft, $category->rgt);
                    $this->createList($children, ($category->depth + 1));
                    echo Html::endTag('ul') . PHP_EOL;
                    echo Html::endTag('div') . PHP_EOL;
                    echo Html::endTag('div') . PHP_EOL;
                    echo Html::endTag('div') . PHP_EOL;
                }
                echo Html::endTag('li') . PHP_EOL;
                $depth = $category->depth;
            }
        }
    }

    /**
     * Получение дочерних категорий.
     *
     * @param $categories array категорий, в которой производится поиск
     * @param $lft integer
     * @param $rgt integer
     * @return array
     */
    private function childCategories($categories, $lft, $rgt)
    {
        $isNested = [];
        foreach ($categories as $category) {
            if ($category->lft > $lft && $category->rgt < $rgt) {
                $isNested[] = $category;
            }
        }

        return $isNested;
    }

    /**
     * Присваивание параметров для тега `ul`.
     *
     * @param $value string может иметь значения `main` или `nested`
     * @return array
     * @throws Exception
     */
    private function ul($value)
    {
        switch ($value) {
            case 'main':
                $optionsTag = ArrayHelper::getValue($this->options, 'main.ul', []);
                break;
            case 'nested':
                $optionsTag = ArrayHelper::getValue($this->options, 'nested.ul', []);
                break;
            default:
                throw new Exception('Параметр $value имеет не корректное значение.');
        }

        return $optionsTag;
    }

    /**
     * Присваивание параметров для тегов `li` и `a`.
     *
     * @param $categories array содержит все объекты категорий
     * @param $category object текущей категория
     * @param $tag string может иметь значения `li` или `a`
     * @return array|mixed
     */
    private function optionsTag($categories, $category, $tag)
    {
        $mainOrNested = $category->depth == 0 ? 'main' : 'nested';
        $lonelyOrHasNesting = $category->lft + 1 == $category->rgt ? 'lonely' : 'hasNesting';

        $keyCommon = "{$mainOrNested}.{$lonelyOrHasNesting}";
        $keyActive = "{$mainOrNested}.active";

        if ($this->active($categories, $category)) {
            $options = $this->glueArray(
                ArrayHelper::getValue($this->options, "{$keyCommon}.{$tag}", []),
                ArrayHelper::getValue($this->options, "{$keyActive}.{$tag}", [])
            );
        } else {
            $options = ArrayHelper::getValue($this->options, "{$keyCommon}.{$tag}", []);
        }

        if ($tag == 'a') {
            $options['href'] = $this->createUrl($categories, $category->id);
        }

        /**
         * Обратная совместимость старого способа передачи параметров для активного пункта меню.
         */
        if ($tag == 'li' && $this->active($categories, $category) &&
            !ArrayHelper::getValue($this->options, "{$keyActive}.li") &&
            !ArrayHelper::getValue($this->options, "{$keyActive}.a")
        ) {
            $options = $this->glueArray(
                ArrayHelper::getValue($this->options, "{$keyCommon}.li", []),
                ArrayHelper::getValue($this->options, $keyActive, []));
        }

        return $options;
    }

    /**
     * Присваивание иконки для тега <a>, если пункт меню имеет вложенность.
     *
     * @param $category object текущей категории
     * @return string
     */
    private function icon($category)
    {
        $main = $category->depth == 1;
        $nesting = $category->lft + 1 != $category->rgt;

        $icon = null;
        if ($nesting) {
            if ($main) {
                $icon = ArrayHelper::getValue($this->options, 'main.hasNesting.icon');
            } else {
                $icon = ArrayHelper::getValue($this->options, 'nested.hasNesting.icon');
            }
        }

        if (!empty($icon)) {
            $prettyIcon = '<i class="' . $icon . '"></i>';
        } else {
            $prettyIcon = null;
        }

        return $prettyIcon;
    }

    /**
     * Проверка, является ли пункт меню активным.
     *
     * @param $categories array
     * @param $category object
     * @return bool
     */
    private function active($categories, $category)
    {
        $request = Yii::$app->request;
        $urlMenu = $this->createUrl($categories, $category->id);
        $currentUrl = '/' . $request->pathInfo;
        $parentUrl = substr_count($request->absoluteUrl, $request->hostInfo . $urlMenu . '/');

        return $parentUrl || $currentUrl == $urlMenu || $currentUrl == '/index';
    }

    /**
     * Объединение параметров у элементов с одинаковыми ключами.
     * К примеру $LI_active_main наследует параметры от $LI_has_nesting_main.
     *
     * @param array|null $main Основные атрибуты пункта меню
     * @param array|null $active Атрибуты пункта меню, если активен
     * @return array
     */
    private function glueArray($main, $active)
    {
        $separator = $main && $active ? ' ' : '';

        $mainKey = array_keys($main);
        $activeKey = array_keys($active);
        $sumArr = array_merge(array_flip($mainKey), array_flip($activeKey));
        foreach ($sumArr as $key => $notNeed) {
            $optionsTag[$key] = ArrayHelper::getValue($main, $key) . $separator . ArrayHelper::getValue($active, $key);
        }

        return isset($optionsTag) ? $optionsTag : [];
    }

    /**
     * Формирование полного адреса для пунктов меню.
     *
     * @param $categories array содержит все объекты категорий
     * @param $id integer текущей категории
     * @return array
     */
    private function createUrl($categories, $id)
    {
        $previous = $categories['0'];
        $path = null;
        $array = null;

        foreach ($categories as $current) {
            if ($current->lft > $previous->lft && $current->rgt < $previous->rgt) {
                $path = $path . '/' . $previous->id;
            } elseif ($current->depth != $previous->depth && $current->depth == '1') {
                $path = null;
            } elseif ($current->depth != $previous->depth) {
                $path = explode('/', $path);
                for ($cycle = $previous->depth - $current->depth; $cycle; $cycle--) {
                    array_pop($path);
                }
                $path = implode('/', $path);
            }
            if ($current->id != '/') {
                $finish_url = $path . '/' . $current->id;
            } else {
                $finish_url = '/';
            }
            $previous = $current;
            $array[$current->id] = $finish_url;
        }

        return $array[$id];
    }
}