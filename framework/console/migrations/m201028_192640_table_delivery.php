<?php

use yii\db\Migration;

/**
 * Class m201115_173505_table_delivery
 */
class m201028_192640_table_delivery extends Migration
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
        $this->createTable($this->TABLE_DELIVERY, array_merge(
            $this->columns(['id', 'shop_id', 'title2', 'amount', 'created_at']),
            []
        ), $tableOptions);

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_DELIVERY_SHOP_ID',
            $this->TABLE_DELIVERY,
            'shop_id',
            $this->TABLE_SHOPS,
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->TABLE_DELIVERY);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_DELIVERY_SHOP_ID', $this->TABLE_DELIVERY);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201115_173505_table_delivery cannot be reverted.\n";

        return false;
    }
    */
}
