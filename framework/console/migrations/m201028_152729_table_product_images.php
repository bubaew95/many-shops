<?php

use yii\db\Migration;

/**
 * Class m201028_152729_table_product_images
 */
class m201028_152729_table_product_images extends Migration
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
        $this->createTable($this->TABLE_PRODUCT_IMAGES, array_merge(
            $this->columns(['id']),
            [
                'product_id' => $this->integer()->unsigned()->notNull()->comment('Продукт'),
                'image' => $this->string(255)->notNull()->comment('Картинка'),
            ]
        ), $tableOptions);

        //Внешний ключ для user_id
        $this->addForeignKey(
            'ADD_FOREIGN_KEY_TABLE_PRODUCT_IMAGES_PRODUCT_ID',
            $this->TABLE_PRODUCT_IMAGES,
            'product_id',
            $this->TABLE_PRODUCTS,
            'id',
            $this->ON_DELETE_CASCADE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ADD_FOREIGN_KEY_TABLE_PRODUCT_IMAGES_PRODUCT_ID', $this->TABLE_PRODUCT_IMAGES);
        return $this->dropTable($this->TABLE_PRODUCT_IMAGES);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201028_152729_table_product_images cannot be reverted.\n";

        return false;
    }
    */
}
