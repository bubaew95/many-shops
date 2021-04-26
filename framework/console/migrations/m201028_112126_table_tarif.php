<?php

use yii\db\Migration;

/**
 * Class m201028_112126_table_tarif
 */
class m201028_112126_table_tarif extends Migration
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
        return $this->createTable($this->TABLE_TARIF, array_merge(
            $this->columns(['id', 'title', 'price', 'active']),
            [
                'text'  => $this->string(1024)->notNull()->comment('Описание'),
            ]
        ), $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable($this->TABLE_TARIF);
    }
}
