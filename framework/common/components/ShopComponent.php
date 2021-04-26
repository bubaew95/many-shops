<?php


namespace common\components;


use common\models\shops\Shops;
use yii\base\Component;

class ShopComponent extends Component
{

    public $id;
    public $catId = 0;
    public $name;
    public $logo;
    public $userId;
    public $activate;
    public $shopHeader = 1;

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function setShopInfo(Shops $shopInfo)
    {
        $this->id = $shopInfo->id;
        $this->catId = $shopInfo->category_id;
        $this->name = $shopInfo->title;
        $this->logo = $shopInfo->logo;
        $this->userId = $shopInfo->user_id;
        $this->activate = $shopInfo->active;
    }

}