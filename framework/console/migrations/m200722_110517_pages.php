<?php

use yii\db\Migration;

/**
 * Class m200722_110517_pages
 */
class m200722_110517_pages extends Migration
{
    const TABLE = '{{%pages}}';
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
        $this->createTable(self::TABLE, [
            'id'            => $this->primaryKey()->unsigned(),
            'keywords'      => $this->string(255)->null()->comment('Ключевые слова'),
            'descriptions'  => $this->string(255)->null()->comment('Краткое описание'),
            'name'          => $this->string(255)->null()->comment('Название страницы'),
            'alias'         => $this->string(255)->unique()->notNull()->comment('Латинское название'),
            'text'          => $this->text()->null()->comment('Текст'),
            'active'        => $this->smallInteger(1)->defaultValue(1)->comment('Активность'),
        ], $tableOptions);

        $this->createIndex(
            'ALIAS_INDEX_PAGE',
            self::TABLE,
            'alias'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200722_110517_pages cannot be reverted.\n";

        return false;
    }
    */
}
