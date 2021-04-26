<?php

use yii\db\Migration;

/**
 * Class m201111_193046_add_column_table_products
 */
class m201111_193046_add_column_table_products extends Migration
{
    use \console\traits\MigrateTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            $this->TABLE_PRODUCTS,
            'img',
            $this->string(255)->notNull()->comment('Картинка')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->TABLE_PRODUCTS, 'img');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201111_193046_add_column_table_products cannot be reverted.\n";

        return false;
    }
    */
}
