<?php

use yii\db\Migration;

/**
 * Class m201028_153328_table_basket
 */
class m201028_153328_table_basket extends Migration
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
        $this->createTable($this->TABLE_BASKET, array_merge(
            $this->columns(['id', 'user_id', 'shop_id', 'created_at', 'updated_at']),
            [
                'product_id' => $this->integer()->unsigned()->notNull()->comment('Продукт'),
                'qty' => $this->integer()->defaultValue(1)->comment('Кол-во'),
            ]
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_BASKET_USER_ID',
            $this->TABLE_BASKET,
            'user_id',
            $this->TABLE_USER,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_BASKET_SHOP_ID',
            $this->TABLE_BASKET,
            'shop_id',
            $this->TABLE_SHOPS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_BASKET_PRODUCT_ID',
            $this->TABLE_BASKET,
            'product_id',
            $this->TABLE_PRODUCTS,
            'id',
            $this->ON_DELETE_CASCADE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_BASKET_USER_ID', $this->TABLE_BASKET);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_BASKET_SHOP_ID', $this->TABLE_BASKET);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_BASKET_PRODUCT_ID', $this->TABLE_BASKET);
        return $this->dropTable($this->TABLE_BASKET);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_153328_table_basket cannot be reverted.\n";

        return false;
    }
    */
}
