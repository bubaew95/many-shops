<?php

use yii\db\Migration;

class m200420_164526_Locations extends Migration
{
    const table_region = '{{%geo_regions}}';
    const table_city = '{{%geo_city}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::table_region, [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->unique()->notNull()->comment('Название'),
        ], $tableOptions);

        $this->createTable(self::table_city, [
            'id'            => $this->primaryKey()->unsigned(),
            'region_id'     => $this->integer()->unsigned()->null()->comment('Регион'),
            'name'          => $this->string(255)->notNull()->comment('Название'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::table_region);
        $this->dropTable(self::table_city);
    }
}