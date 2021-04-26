<?php

use yii\db\Migration;

/**
 * Class m210223_133415_add_column_table_pages
 */
class m210223_133415_add_column_table_pages extends Migration
{
    use \console\traits\MigrateTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            $this->TABLE_PAGES,
            'shop_id',
            $this->integer()->unsigned()->null()->comment('Магазин')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->TABLE_PAGES, 'shop_id');
    }
}
