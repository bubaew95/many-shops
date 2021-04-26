<?php

use yii\db\Migration;

/**
 * Class m201028_114518_table_payment_account
 */
class m201028_114518_table_payment_account extends Migration
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
        $this->createTable($this->TABLE_PAYMENT_ACCOUNT, array_merge(
            $this->columns(['id', 'user_id', 'tarif_id', 'active']),
            [
                'free'      => $this->smallInteger(1)->defaultValue(0)->comment('Бесплатный доступ'),
                'start_date_payment' => $this->integer()->unsigned()->comment('Дата оплаты'),
                'end_date_payment'   => $this->integer()->unsigned()->comment('Дата окончания оплаты'),
            ]
        ), $tableOptions);

        $this->addForeignKey(
            'FOREIGN_KEY_PAYMENT_TABLE_USER_ID',
            $this->TABLE_PAYMENT_ACCOUNT,
            'user_id',
            $this->TABLE_USER,
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'FOREIGN_KEY_PAYMENT_TABLE_TARIF_ID',
            $this->TABLE_PAYMENT_ACCOUNT,
            'tarif_id',
            $this->TABLE_TARIF,
            'id'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FOREIGN_KEY_PAYMENT_TABLE_USER_ID', $this->TABLE_PAYMENT_ACCOUNT);
        $this->dropForeignKey('FOREIGN_KEY_PAYMENT_TABLE_TARIF_ID', $this->TABLE_PAYMENT_ACCOUNT);
        return $this->dropTable($this->TABLE_PAYMENT_ACCOUNT);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_114518_table_payment_account cannot be reverted.\n";

        return false;
    }
    */
}
