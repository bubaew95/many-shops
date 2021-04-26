<?php

use yii\db\Migration;

/**
 * Class m210203_191708_table_user_delivery
 */
class m210203_191708_table_user_address extends Migration
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
        $this->createTable($this->TABLE_USER_ADDRESS, array_merge(
            $this->columns(['id', 'user_id', 'region_id', 'city_id']),
            [
                'address'   => $this->string(255)->null()->comment('Адрес'),
                'post_code' => $this->integer()->null()->defaultValue(null)->comment('Почтовый индекс'),
            ]
        ), $tableOptions);

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_USER_ID',
            $this->TABLE_USER_ADDRESS,
            'user_id',
            $this->TABLE_USER,
            'id'
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_REGION_ID',
            $this->TABLE_USER_ADDRESS,
            'region_id',
            $this->TABLE_REGIONS,
            'id'
        );

        //Внешний ключ для status_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_CITY_ID',
            $this->TABLE_USER_ADDRESS,
            'city_id',
            $this->TABLE_CITY,
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_USER_ID', $this->TABLE_USER_ADDRESS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_REGION_ID', $this->TABLE_USER_ADDRESS);
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_USER_DELIVRY_CITY_ID', $this->TABLE_USER_ADDRESS);
        $this->dropTable($this->TABLE_USER_ADDRESS);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_191708_table_user_delivery cannot be reverted.\n";

        return false;
    }
    */
}
