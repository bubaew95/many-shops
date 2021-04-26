<?php

namespace console\traits;

use yii\db\Migration;

/**
 * @mixin Migration
 */
trait MigrateTrait
{
    public $TABLE_IND                   = '{{%users_ind}}';
    public $TABLE_LEG                   = '{{%users_leg}}';
    public $TABLE_DRIVER                = '{{%users_driver}}';
    public $TABLE_PAGES                 = '{{%pages}}';

    public $TABLE_USER                  = '{{%users}}';
    public $TABLE_TARIF                 = '{{%tarif}}';
    public $TABLE_PAYMENT_ACCOUNT       = '{{%payment_account}}';
    public $TABLE_CATEGORIES            = '{{%categories}}';
    public $TABLE_CATEGORIES_TO_SHOP    = 'categories_to_shop';
    public $TABLE_SHOPS                 = '{{%shops}}';
    public $TABLE_PRODUCTS              = '{{%products}}';
    public $TABLE_PRODUCT_IMAGES        = '{{%product_images}}';
    public $TABLE_BASKET                = '{{%basket}}';
    public $TABLE_STATUSES              = '{{%statuses}}';
    public $TABLE_ORDERS                = '{{%orders}}';
    public $TABLE_ORDER_ITEMS           = '{{%order_items}}';
    public $TABLE_REGIONS               = '{{%geo_regions}}';
    public $TABLE_CITY                  = '{{%geo_city}}';
    public $TABLE_DELIVERY              = '{{%delivery}}';
    public $TABLE_ORDERS_TO_STATUS      = '{{%orders_to_status}}';
    public $TABLE_USER_ADDRESS          = '{{%user_address}}';


    public $ON_DELETE_CASCADE = 'CASCADE';

    public function columns($columnNames)
    {
        $columns = [];

        foreach ($columnNames as $columnName) {
            switch ($columnName) {
                case 'id' :
                    $columns['id']          = $this->primaryKey()->unsigned(); break;
                case 'user_id':
                    $columns['user_id']     = $this->integer()->unsigned()->notNull()->comment('Пользователь'); break;
                case 'tarif_id':
                    $columns['tarif_id']    = $this->integer()->unsigned()->notNull()->comment('Тариф'); break;
                case 'category_id':
                    $columns['category_id'] = $this->integer()->unsigned()->notNull()->comment('Категория'); break;
                case 'shop_id':
                    $columns['shop_id']     = $this->integer()->unsigned()->notNull()->comment('Магазин'); break;
                case 'status_id':
                    $columns['status_id']   = $this->integer()->unsigned()->notNull()->comment('Статус'); break;
                case 'delivery_id':
                    $columns['delivery_id'] = $this->integer()->unsigned()->notNull()->comment('Доставка'); break;
                case 'order_id':
                    $columns['order_id']    = $this->integer()->unsigned()->notNull()->comment('Заказ'); break;
                case 'city_id':
                    $columns['city_id']     = $this->integer()->unsigned()->notNull()->comment('Город'); break;
                case 'region_id':
                    $columns['region_id']   = $this->integer()->unsigned()->notNull()->comment('Регион'); break;

                case 'created_at':
                    $columns['created_at'] = $this->integer()->unsigned()->notNull()->comment('Дата создания'); break;
                case 'updated_at':
                    $columns['updated_at'] = $this->integer()->unsigned()->notNull()->comment('Дата редактирования'); break;
                case 'position':
                    $columns['position'] = $this->integer()->notNull(); break;
                case 'active' :
                    $columns['active'] = $this->boolean()->defaultValue(1)->comment('Активность'); break;
                case 'title' :
                    $columns['title'] = $this->string(255)->notNull()->defaultValue('')->comment('Название');
                    $columns['alias'] = $this->string(255)->unique()->notNull()->defaultValue('')->comment('Алиас');
                    break;
                case 'title2' :
                    $columns['title'] = $this->string(255)->notNull()->defaultValue('')->comment('Название');
                    break;
                case 'comment' :
                    $columns['comment'] = $this->text()->comment('Комментарий'); break;
                case 'content' :
                    $columns['content'] = $this->text()->comment('Контент'); break;
                case 'description' :
                    $columns['description'] = $this->text()->comment('Описание'); break;
                case 'alias' :
                    $columns['alias'] = $this->string(255)->unique()->notNull()->defaultValue('')->comment('Алиас'); break;
                case 'sort' :
                    $columns['sort'] = $this->integer()->defaultValue(500)->comment('Сортировка'); break;
                case 'image' :
                    $columns['image'] = $this->string(500)->null()->comment('Картинка');
                    break;
                case 'icon' :
                    $columns['icon'] = $this->string(255)->null()->comment('Иконка');
                    break;
                case 'seo' :
                    $columns['meta_d'] = $this->string(255)->null()->comment('Описание страницы');
                    $columns['meta_k'] = $this->string(255)->null()->comment('Ключевые слова');
                    break;

                case 'nested_sets':
                    $columns['parent_id'] = $this->integer();
                    $columns['lft'] = $this->integer()->notNull();
                    $columns['rgt'] = $this->integer()->notNull();
                    $columns['depth'] = $this->integer()->notNull();
                    break;

                case 'price':
                    $columns['price'] = $this->decimal(8,2)->notNull()->comment('Цена'); break;
                case 'amount':
                    $columns['amount'] = $this->decimal(8,2)->null()->defaultValue(0)->comment('Сумма'); break;
                case 'ship':
                    $columns['ship_address']    = $this->string(255)->notNull()->comment('Адрес доставки');
                    $columns['ship_country']    = $this->string(255)->null()->comment('Регион');
                    $columns['ship_region']     = $this->integer()->unsigned()->null()->defaultValue(null)->comment('Регион');
                    $columns['ship_city']       = $this->integer()->unsigned()->notNull()->defaultValue(null)->comment('Город/Село');
                    $columns['ship_zip']        = $this->string(10)->notNull()->comment('Почтовый индекс');
                    break;
            }
        }

        return $columns;
    }

    public function defaultColumns()
    {
        return $this->columns(['id', 'title', 'active', 'created_at', 'updated_at']);
    }
}