<?php

use yii\db\Migration;

/**
 * Class m201028_193654_table_orders
 */
class m201028_193654_table_orders extends Migration
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
        $this->createTable($this->TABLE_ORDERS, array_merge(
            $this->columns(['id', 'user_id', 'ship', 'created_at', 'updated_at']),
            []
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_USER_ID',
            $this->TABLE_ORDERS,
            'user_id',
            $this->TABLE_USER,
            'id'
        );

        //Внешний ключ для ship_city
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_ship_city',
            $this->TABLE_ORDERS,
            'ship_city',
            $this->TABLE_CITY,
            'id'
        );

        //Внешний ключ для ship_region
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_ORDERS_ship_region',
            $this->TABLE_ORDERS,
            'ship_region',
            $this->TABLE_REGIONS,
            'id'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_ORDERS_USER_ID', $this->TABLE_ORDERS);
        return $this->dropTable($this->TABLE_ORDERS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_193654_table_orders cannot be reverted.\n";

        return false;
    }
    */
}
