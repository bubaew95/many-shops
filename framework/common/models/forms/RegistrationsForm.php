<?php


namespace common\models\forms;


use common\models\user\UsersInd;
use common\models\user\UsersLeg;
use common\traits\HelperTrait;
use common\components\Mailer;
use common\models\user\User;
use Yii;
use yii\base\Model;
use yii\helpers\HtmlPurifier;
use yii\imagine\Image;
use yii\web\UploadedFile;

class RegistrationsForm extends Model
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region' => 'Регион',
            'city' => 'Город',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'image' => 'Изображение',
            'password' => 'Пароль',
            'repassword' => 'Подтвердить пароль',
            'is_allow' => 'Пользовательское соглащение'
        ];
    }

    /**
     * Обновить пользователя
     * @param User $user
     * @param $type
     * @return bool
     */
    public function updateUser(User $user, $type)
    {
        if(!$this->validate()) return false;

        $image = $this->uploadImage(
            $type instanceof UsersLeg ? 'leg' : 'ind'
        );

        if( $image !== 'images/no-image.jpg' )
        {
            if(file_exists("{$user->image}")) {
                unlink("{$user->image}");
            }
            $user->image = $image;
        }

        $user->phone = HelperTrait::clearPhone($this->phone);
        $user->email = $this->email;

        if(!empty($this->password)) {
            if($this->password != $this->repassword) {
                return $this->addError('repassword', 'Пароли не совпадают');
            }

            $user->generateAuthKey();
            $user->setPassword( $this->password );
        }

        if($type instanceof UsersInd) {
            $type->birthday  = $this->birthday;
            $type->firstname = $this->firstname;
            $type->name      = $this->name;
            $type->lastname  = $this->lastname;
        }

        if($type instanceof UsersLeg) {
            $type->org_name = $this->org_name;
            $type->inn      = $this->inn;
        }
        $type->save();

        if(!$user->save()) {
            Yii::$app->session->setFlash('danger', debug($user->errors));
            return false;
        }

        Yii::$app->session->setFlash('success', 'Данные успешно отредактированы');
        return true;
    }

    /**
     * Добавить пользователя
     * @param $imagePath
     * @param $type
     * @return User
     */
    protected function userSave($imagePath, $type): User
    {
        $userModel              = new User();
        $userModel->email       = HtmlPurifier::process($this->email);
        $userModel->phone       = HelperTrait::clearPhone($this->phone);
        $userModel->type        = $type;

        if($this->scenario != 'update') {
            $userModel->image = $imagePath;
        }

        if(!is_null($this->password)) {
            $userModel->generateAuthKey();
            $userModel->setPassword( $this->password );
        }

        $userModel->save();
        return $userModel;
    }

    /**
     * Загрузка изображение
     * @return string|null
     */
    protected function uploadImage($type): ?String
    {
        $this->image = UploadedFile::getInstance($this, 'image');

        if(!$this->image) return 'images/no-image.jpg';

        if ($this->validate()) {
            $uploadPath = "uploads/{$type}";

            if(!is_dir( $uploadPath )) {
                mkdir($uploadPath, 0777, true);
            }

            $fileName   = md5(uniqid(rand(), true)) . '.' . $this->image->extension;
            $filePath   = "{$uploadPath}/{$fileName}";

            if($this->image->saveAs($filePath)) {
                Image::resize($filePath, IMAGE_CROP_WIDTH, IMAGE_CROP_HEIGHT, IMAGE_CROP_KAR)->save(
                    $filePath,
                    ['quality' => 90]
                );
            }
            return $filePath;
        } else {
//            debug($this->errors);
            return null;
        }
    }

    /**
     * @param $email
     * @param $text
     * @param $model
     * @param $type
     * @return \yii\mail\MessageInterface
     */
    protected function sendMail($email, $text, $model )
    {
        $mailer = new Mailer();
        return $mailer->send(
            $email,
            "Регистрация на сайте " . Yii::$app->settings->get('Site.siteName'),
            [
                ['html' => 'registration-html'],
                ['user' => $model]
            ]
        );
    }
}