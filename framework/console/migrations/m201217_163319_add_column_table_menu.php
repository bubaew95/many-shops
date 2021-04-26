<?php

use yii\db\Migration;

/**
 * Class m201217_163319_add_column_table_menu
 */
class m201217_163319_add_column_table_menu extends Migration
{
    use \console\traits\MigrateTrait;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        return true;
        
        $this->addColumn(
            $this->TABLE_CATEGORIES,
            'shop_id',
            $this->integer()->unsigned()->null()->comment('Магазин')
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_MENU_SHOP_ID',
            $this->TABLE_CATEGORIES,
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
        $this->dropColumn($this->TABLE_CATEGORIES, 'shop_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201217_163319_add_column_table_menu cannot be reverted.\n";

        return false;
    }
    */
}
