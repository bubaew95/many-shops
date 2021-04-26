<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    const TABLE = '{{%users}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id'                    => $this->primaryKey()->unsigned(),
            'phone'                 => $this->string(40)->notNull()->unique()->comment('Номер телефона'),
            'email'                 => $this->string(255)->null()->comment('E-mail'),
            'type'                  => $this->smallInteger(1)->defaultValue(1)->comment('Тип пользователя'),
            'image'                 => $this->string(255)->null()->defaultValue('images/no-image.jpg')->comment('Изображение'),

            'auth_key'              => $this->string(32)->null()->comment('Токен'),
            'verification_token'    => $this->string(255)->null()->comment('Токен верифликации'),
            'password_hash'         => $this->string(255)->null()->comment('Пароль'),
            'password_reset_token'  => $this->string(255)->unique()->comment('Ключ восстановления пароля'),
            'status'                => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус пользователя'),
            'created_at'            => $this->integer()->notNull()->defaultValue(0)->comment('Дата регистрации'),
            'updated_at'            => $this->integer()->notNull()->defaultValue(0)->comment('Дата обновлении'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE );
    }
}
