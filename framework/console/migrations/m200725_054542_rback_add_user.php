<?php

use yii\db\Migration;

/**
 * Class m200725_054542_rback_add_user
 */
class m200725_054542_rback_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createUser();
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');

        // запишем их в БД
        $auth->add($admin);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('is_view_admin');
        $viewAdminPage->description = 'Просмотр админки';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);
    }

    private function createUser()
    {
        $user = new \common\models\user\User();
        $user->type = 1;
        $user->phone = '79280010203';
        $user->email = 'test@mail.ru';
        $user->setPassword('123');
        $user->generateAuthKey();
        $user->save();

        $userInd = new \common\models\user\UsersInd();
        $userInd->name = 'admin';
        $userInd->lastname = 'test';
        $userInd->firstname = 'test';
        return $userInd->link('user', $user);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200725_054542_rback_add_user cannot be reverted.\n";

        return false;
    }
    */
}
