<?php

namespace common\modules\shops\frontend\widgets;

use common\models\products\Products;
use common\traits\HelperTrait;
use yii\base\Widget;

class ItemsWidget extends Widget
{
    public $shopName;
    public $template = 'items-grid';
    public $subTemplate = 'items-home-grid';
    public $model;
    public $limit = 9;
    public $offset = 0;
    public $pagination;
    public $where;
    public $classOne = 'col-6 col-md-4 col-wd-3 product-item';
    public $classTwo = 'product-item__inner px-wd-4 p-2 p-md-3';

    public $isUl      = false;
    public $classImg  = 'max-width-120 d-block';
    public $classPrI  = '';
    public $classPrIO = 'product-item__outer h-100 w-100';
    public $classPrII = 'product-item__inner p-md-3 row no-gutters';
    public $classPrIB = 'col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0';
    public $classLast = '';
    public $classFirst = '';
    public $tabItems = 1;
    public $divOptions = null;
    public $ulOptions = null;

    /**
     * Начало
     */
    public function init()
    {
        if( is_null($this->shopName) ) {
            $this->shopName = HelperTrait::get('alias');
        }

        if($this->model === null) {
            $model = Products::find();

            if($this->shopName) {
                $model->shopProducts($this->shopName);
            }

            $model->offset($this->offset)
                ->limit($this->limit);

            if(!empty($this->where)) {
                $model->where($this->where);
            }

            $this->model = $model->all();
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        if(!$this->model) return null;

        return $this->render($this->template, [
            'subTemplate' => $this->subTemplate,
            'model'      => $this->model,
            'pagination' => $this->pagination,
            'isUl'       => $this->isUl,
            'classOne'   => $this->classOne,
            'classTwo'   => $this->classTwo,

            'classPrI'   => $this->classPrI,
            'classPrIO'  => $this->classPrIO,
            'classPrII'  => $this->classPrII,
            'classImg'   => $this->classImg,
            'classPrIB'  => $this->classPrIB,
            'classFirst' => $this->classFirst,
            'classLast'  => $this->classLast,
            'tabItems'   => $this->tabItems,
            'divOptions' => $this->divOptions,
            'ulOptions'  => $this->ulOptions
        ]);
    }

}