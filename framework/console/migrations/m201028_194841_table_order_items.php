<?php

use yii\db\Migration;

/**
 * Class m201028_194841_table_order_items
 */
class m201028_194841_table_order_items extends Migration
{
    use \console\traits\MigrateTrait;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //В закладки
        $this->createTable($this->TABLE_ORDER_ITEMS, array_merge(
            $this->columns(['id', 'order_id', 'delivery_id', 'shop_id', 'status_id', 'price', 'image']),
            [
                'product_id' => $this->integer()->unsigned()->notNull()->comment('Продукт'),
                'order_id' => $this->integer()->unsigned()->notNull()->comment('Заказы'),
                'qty' => $this->integer()->unsigned()->defaultValue(1)->comment('Кол-во'),
                'title' => $this->string(255)->notNull()->comment('Название'),
            ]
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_PRODUCT_ID',
            $this->TABLE_ORDER_ITEMS,
            'product_id',
            $this->TABLE_PRODUCTS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_SHOP_ID',
            $this->TABLE_ORDER_ITEMS,
            'shop_id',
            $this->TABLE_SHOPS,
            'id'
        );

        //Внешний ключ для delivery_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_DELIVERY_ID',
            $this->TABLE_ORDER_ITEMS,
            'delivery_id',
            $this->TABLE_DELIVERY,
            'id'
        );

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_ORDER_ID',
            $this->TABLE_ORDER_ITEMS,
            'order_id',
            $this->TABLE_ORDERS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_STATUS_ID',
            $this->TABLE_ORDER_ITEMS,
            'status_id',
            $this->TABLE_STATUSES,
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_ORDERS_PRODUCT_ID', $this->TABLE_ORDER_ITEMS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_SHOP_ID', $this->TABLE_ORDER_ITEMS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_ORDERS_ORDER_ID', $this->TABLE_ORDER_ITEMS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_ORDER_ITEMS_STATUS_ID', $this->TABLE_ORDER_ITEMS);
        return $this->dropTable($this->TABLE_ORDER_ITEMS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_194841_table_order_items cannot be reverted.\n";

        return false;
    }
    */
}
