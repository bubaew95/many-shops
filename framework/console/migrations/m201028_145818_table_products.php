<?php

use yii\db\Migration;

/**
 * Class m201028_145818_table_products
 */
class m201028_145818_table_products extends Migration
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
        $this->createTable($this->TABLE_PRODUCTS, array_merge(
            $this->columns(['id', 'shop_id', 'category_id', 'title', 'seo', 'price', 'created_at', 'updated_at', 'active']),
            [
                'text'              => $this->text()->null()->comment('Описание'),
                'discount'          => $this->smallInteger(2)->defaultValue(0)->comment('Скидка'),
                'specifications'    => $this->text()->null()->comment('Характеристики'),
                'is_installment'    => $this->smallInteger(1)->defaultValue(0)->comment('Рассрочка'),
                'pre_order_price'   => $this->decimal(8,2)->defaultValue(0)->comment('Цена за предзаказ'),
            ]
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_PRODUCTS_SHOP_ID',
            $this->TABLE_PRODUCTS,
            'shop_id',
            $this->TABLE_SHOPS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для category_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_PRODUCTS_CATEGORY_ID',
            $this->TABLE_PRODUCTS,
            'category_id',
            $this->TABLE_CATEGORIES,
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_PRODUCTS_SHOP_ID', $this->TABLE_PRODUCTS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_PRODUCTS_CATEGORY_ID', $this->TABLE_PRODUCTS);
        return $this->dropTable($this->TABLE_SHOPS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_145818_table_products cannot be reverted.\n";

        return false;
    }
    */
}
