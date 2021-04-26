<?php

use yii\db\Migration;

/**
 * Class m200709_105259_user_type_tables
 */
class m130524_201452_user_type_tables extends Migration
{
    const TABLE_IND     = '{{%users_ind}}';
    const TABLE_LEG     = '{{%users_leg}}';
    const TABLE_DRIVER  = '{{%users_driver}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //Физ лицо
        $this->createTable(self::TABLE_IND, [
            'id'        => $this->primaryKey()->unsigned(),
            'user_id'   => $this->integer()->unsigned()->comment('Пользователь'),
            'firstname' => $this->string()->notNull()->comment('Фамилия'),
            'name'      => $this->string()->notNull()->comment('Имя'),
            'lastname'  => $this->string()->null()->comment('Отчество'),
        ], $tableOptions);

        //Юр.лицо
        $this->createTable(self::TABLE_LEG, [
            'id'            => $this->primaryKey()->unsigned(),
            'user_id'       => $this->integer()->unsigned()->comment('Пользователь'),
            'org_name'      => $this->string()->notNull()->comment('Название организации'),
            'inn'           => $this->string()->notNull()->comment('ИНН'),
        ], $tableOptions);

        $this->foreignKeys();
    }

    private function foreignKeys()
    {
        $tables = [self::TABLE_IND, self::TABLE_LEG];
        foreach ($tables as $key => $item) {
            $clearTable = str_replace(['{', '}', '%'], '', $item);
            $this->createIndex(
                "{$clearTable}-user_id",
                $item,
                'user_id'
            );

            $this->addForeignKey(
                "FOREIGHN_KEY_{$key}_{$clearTable}",
                $item,
                'user_id',
                '{{%users}}',
                'id',
                'CASCADE'
            );
        }
    }

    private function deleteForeignKeys()
    {
        $tables = [self::TABLE_IND, self::TABLE_IND, self::TABLE_DRIVER];
        foreach ($tables as $key => $item) {
            $clearTable = str_replace(['{', '}', '%'], '', $item);
            $this->dropForeignKey("FOREIGHN_KEY_{$key}_{$clearTable}", $item);
            $this->dropIndex("{$clearTable}-user_id", $item);
        }
    }

    public function down()
    {
//        $this->deleteForeignKeys();

        $this->dropTable(self::TABLE_IND );
        $this->dropTable(self::TABLE_LEG );
    }

}
