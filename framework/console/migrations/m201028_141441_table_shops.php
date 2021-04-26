<?php

use yii\db\Migration;

/**
 * Class m201028_141441_table_shops
 */
class m201028_141441_table_shops extends Migration
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
        $this->createTable($this->TABLE_SHOPS, array_merge(
            $this->columns(['id', 'user_id', 'category_id', 'title', 'seo', 'created_at', 'updated_at', 'active']),
            [
                'text' => $this->string(255)->null()->comment('Описание'),
                'logo' => $this->string(255)->null()->comment('Логотип')
            ]
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
          'ADD_FOREIGN_KEY_TABLE_SHOPS_USER_ID',
          $this->TABLE_SHOPS,
          'user_id',
          $this->TABLE_USER,
          'id',
          $this->ON_DELETE_CASCADE
        );

        //Внешний ключ для category_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_SHOPS_CATEGORY_ID',
            $this->TABLE_SHOPS,
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
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_SHOPS_USER_ID', $this->TABLE_SHOPS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_SHOPS_CATEGORY_ID', $this->TABLE_SHOPS);
        return $this->dropTable($this->TABLE_SHOPS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_141441_table_shops cannot be reverted.\n";

        return false;
    }
    */
}
