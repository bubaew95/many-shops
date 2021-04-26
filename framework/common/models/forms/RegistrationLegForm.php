<?php
namespace common\models\forms;

use common\models\user\User;
use common\models\user\UsersLeg;
use common\traits\HelperTrait;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;

/**
 * Login form
 */
class RegistrationLegForm extends RegistrationsForm
{
    public $org_name;
    public $inn;
    public $phone;
    public $email;
    public $image;
    public $password;
    public $repassword;

    public $is_allow;

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['org_name', 'inn', 'phone', 'email', 'password', 'repassword'],
                'required',
                'on' => self::SCENARIO_DEFAULT
            ],
            [
                ['org_name', 'inn', 'phone', 'email'],
                'required',
                'on' => self::SCENARIO_UPDATE
            ],

            [
                ['image'], 'image', 'skipOnEmpty' => true,
                'extensions' => ['png', 'jpg']
            ],

            [['org_name'], 'string', 'max' => 255],
            [['inn'], 'string', 'min' => 10, 'max' => 12],

            [['email', 'phone'], 'phoneAndEmailUniqueValid', 'skipOnEmpty'=> false],
            [['email'], 'email'],
            [['repassword', 'password'], 'string', 'min' => 6, 'max' => 32],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],

            [['is_allow',], 'boolean'],
            ['is_allow', 'compare', 'compareValue' => 1, 'message' => 'Необходимо дать согласие для дальнейшей регистрации.'],
        ];
    }

    /**
     * Проверка валидности номера телефона
     * @param $attribute
     */
    public function phoneAndEmailUniqueValid()
    {
        if (!$this->hasErrors()) {
            if (User::findPhone($this->phone)) {
                $this->addError('phone', 'Такой номер телефона уже зарегистрирован');
            }

            if(!empty($this->email) && User::findEmail($this->email)) {
                $this->addError('email', 'Емайл уже занят');
            }
        }
    }

    /**
     * Проверка валидности номера телефона
     * @param $attribute
     */
    public function phoneUniqueValid($attribute)
    {
        if (!$this->hasErrors()) {
            if (User::findPhone($this->phone)) {
                $this->addError($attribute, 'Такой номер телефона уже зарегистрирован');
            }
        }
    }

    /**
     * Проверка валидности емайла
     * @param $attribute
     */
    public function emailUniqueValid($attribute)
    {
        if (!$this->hasErrors()) {
            if (User::findEmail($this->email)) {
                $this->addError($attribute, 'Емайл уже занят');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge([
            'org_name' => 'Название организации',
            'inn' => 'ИНН',
        ], parent::attributeLabels());
    }

    /**
     * Добавление данных в БД
     * @return bool
     */
    public function save(): bool
    {
        if(!$this->validate()) return false;
        try {
            $imagePath  = $this->uploadImage('leg');
            $userModel  = $this->userSave($imagePath, 2);

            $userIndModel           = new UsersLeg();
            $userIndModel->org_name = HtmlPurifier::process($this->org_name);
            $userIndModel->inn      = HelperTrait::clearPhone($this->inn);

            $userModel->link('leg', $userIndModel);

            $flashMessage = 'Спасибо за регистрацию на нашем сайте';

            if( $this->email ) :
                $text  = "Ваш логин: {$this->email}\r\n";
                $text .= "Ваш пароль: {$this->password}";
                $this->sendMail($this->email, $text, $userModel);
            endif;

            Yii::$app->session->setFlash('success', $flashMessage);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
