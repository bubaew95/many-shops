<?php

use yii\db\Migration;

/**
 * Class m201120_084046_orders_to_status
 */
class m201120_084046_orders_to_status extends Migration
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
        $this->createTable($this->TABLE_ORDERS_TO_STATUS, array_merge(
            $this->columns(['id', 'shop_id', 'order_id', 'status_id']),
            []
        ), $tableOptions);

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_TO_STATUS_SHOP_ID',
            $this->TABLE_ORDERS_TO_STATUS,
            'shop_id',
            $this->TABLE_SHOPS,
            'id'
        );

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_TO_STATUS_ORDER_ID',
            $this->TABLE_ORDERS_TO_STATUS,
            'order_id',
            $this->TABLE_ORDERS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_TO_STATUS_STATUS_ID',
            $this->TABLE_ORDERS_TO_STATUS,
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
        $this->dropTable($this->TABLE_ORDERS_TO_STATUS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201120_084046_orders_to_status cannot be reverted.\n";

        return false;
    }
    */
}
