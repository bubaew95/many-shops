<?php


namespace common\modules\categories\components;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Menu extends \yii\widgets\Menu
{
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {

            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{id}' => $item['id'],
                    '{items}' => $this->renderItems($item['items']),
                ]);
//                $tag = 'div';
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    private function renderLinkStr($item, $options)
    {
        if( array_key_exists('isItems', $item) && $item['isItems'] ) {
            $options['class'] .= ' u-header__nav-link-toggle';
        }

        return strtr(Html::tag('a', '{label}', $options), [
            '{url}'   => $item['url'],
            '{label}' => $item['label'],
            '{id}'    => $item['id'],
        ]);
    }

    private function renderArrayLink($item)
    {
        if(isset($item['template'])) return $this->renderLinkStr($item, []);
        $linkTemplate = [ 'href' => '{url}', 'id' => '{id}' ];
        $options = ArrayHelper::merge(ArrayHelper::getValue($item, 'linkTemplate', $linkTemplate), $this->linkTemplate);
        return $this->renderLinkStr($item, $options);
    }

    private function renderArrayTemplate($item)
    {
        $linkTemplate = [ 'href' => '{url}', 'id' => '{id}' ];
        $options = ArrayHelper::merge($linkTemplate, $item['template']);
        return $this->renderLinkStr($item, $options);
    }

    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue( $item, 'template', $this->linkTemplate);

            if(is_array($this->linkTemplate)) {
                return $this->renderArrayLink($item);
            }

            if(is_array($item['template'])) {
                return  $this->renderArrayTemplate($item);
            }

            return strtr($template, [
                '{url}'   => $item['url'],
                '{label}' => $item['label'],
                '{id}'    => $item['id']
            ]);
        }
        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
        return strtr($template, [ '{label}' => $item['label'] ]);
    }

}