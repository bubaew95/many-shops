<?php

use yii\db\Migration;

/**
 * Class m201028_145002_table_category
 */
class m201028_114532_table_category extends Migration
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

        $this->createTable($this->TABLE_CATEGORIES, array_merge(
            $this->columns(['id', 'icon', 'title']),
            [
                'tree'      => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Дерево'),
                'lft'       => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Левая сторона'),
                'rgt'       => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Правая сторона'),
                'depth'     => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Глубина'),
                'position'  => $this->integer()->unsigned()->notNull()->defaultValue(0)->defaultValue(0)->comment('Позиция'),
                'block'     => "ENUM('top', 'sidebar', 'bottom') COMMENT 'Расположение'",
            ]
        ), $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->TABLE_CATEGORIES);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_145002_table_category cannot be reverted.\n";

        return false;
    }
    */
}
