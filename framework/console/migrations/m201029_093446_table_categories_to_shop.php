<?php

use yii\db\Migration;

/**
 * Class m201029_093446_table_categories
 */
class m201029_093446_table_categories_to_shop extends Migration
{
    use \console\traits\MigrateTrait;

    public function safeUp()
    {
        //
        $this->createTable(
            $this->TABLE_CATEGORIES_TO_SHOP,
            $this->columns(['id', 'shop_id', 'title2', 'category_id', 'active'])
        );

        //Внешний ключ shop id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_CATEGORIES_TO_SHOP_SHOP_ID',
            $this->TABLE_CATEGORIES_TO_SHOP,
            'shop_id',
            $this->TABLE_SHOPS,
            'id',
            $this->ON_DELETE_CASCADE
        );

        //Внешний ключ shop id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_CATEGORIES_TO_SHOP_CATEGORY_ID',
            $this->TABLE_CATEGORIES_TO_SHOP,
            'category_id',
            $this->TABLE_CATEGORIES,
            'id',
            $this->ON_DELETE_CASCADE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_CATEGORIES_TO_SHOP_SHOP_ID', $this->TABLE_CATEGORIES_TO_SHOP);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_CATEGORIES_TO_SHOP_CATEGORY_ID', $this->TABLE_CATEGORIES_TO_SHOP);
        return $this->dropTable($this->TABLE_CATEGORIES);
    }
}
