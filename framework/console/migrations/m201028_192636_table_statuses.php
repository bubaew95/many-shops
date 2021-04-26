<?php

use yii\db\Migration;

/**
 * Class m201028_192636_table_statuses
 */
class m201028_192636_table_statuses extends Migration
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
        $this->createTable($this->TABLE_STATUSES, array_merge(
            $this->columns(['id']),
            [
                'title' => $this->string(100)->notNull()->unique()->comment('Название'),
                'color' => $this->string(50)->null()->comment('Цвет')
            ]
        ), $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable($this->TABLE_STATUSES);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_192636_table_statuses cannot be reverted.\n";

        return false;
    }
    */
}
