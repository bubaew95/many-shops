<?php
namespace common\models\forms;

use Yii;
use common\models\user\User;
use common\models\user\UsersInd;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/**
 * Login form
 */
class RegistrationIndForm extends RegistrationsForm
{
    public $name;
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $image;
    public $password;
    public $repassword;
    public $birthday;

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
                ['name', 'firstname', 'lastname', 'phone', 'password', 'repassword', 'is_allow'],
                'required', 'on' => self::SCENARIO_DEFAULT
            ],
            [
                ['name', 'firstname', 'lastname', 'phone'],
                'required', 'on' => self::SCENARIO_UPDATE
            ],
            [
                ['image'], 'image', 'skipOnEmpty' => true,
                'extensions' => ['png', 'jpg']
            ],
            [['name', 'firstname', 'lastname', 'email', 'birthday'], 'string', 'max' => 255],
            [['email', 'phone'], 'phoneAndEmailUniqueValid', 'skipOnEmpty'=> false],
            [['repassword', 'password'], 'string', 'min' => 6, 'max' => 32],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],

            [['is_allow',], 'boolean'],
            ['is_allow', 'compare', 'compareValue' => 1, 'message' => 'Необходимо дать согласие для дальнейшей регистрации.'],

            ['birthday', function($attribute, $params, $validator) {
                if(!empty($this->birthday)) {
                    list($d, $m, $y) = explode('-', $this->birthday);

                    if($d < 1 or $m < 1 or $y < 1)
                        $this->addError('birthday', 'Значение не может быть меньше 1');

                    if($d > 31)
                        $this->addError('birthday', 'День не может быть больще 31 числа');
                    if($m > 12)
                        $this->addError('birthday', 'Число месяца не может привышать 12');
                    if($y >= date('Y'))
                        $this->addError('birthday', "Год не может быть равен текущему году");
                }
            }],
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

            if (!empty($this->email) && User::findEmail($this->email)) {
                $this->addError('email', 'Емайл уже занят');
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
            'name' => 'Имя',
            'firstname' => 'Фамилия',
            'lastname' => 'Отчество',
            'birthday' => 'Дата рождения'
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
            $imagePath = null;

            if($this->scenario != 'update') {
                $imagePath  = $this->uploadImage('ind');
            }

            $userModel  = $this->userSave($imagePath, 1);

            $userIndModel            = new UsersInd();
            $userIndModel->firstname = HtmlPurifier::process($this->firstname);
            $userIndModel->name      = HtmlPurifier::process($this->name);
            $userIndModel->lastname  = HtmlPurifier::process($this->lastname);
            $userIndModel->birthday  = HtmlPurifier::process($this->birthday);

            $userModel->link('ind', $userIndModel);

            $flashMessage = 'Спасибо за регистрацию на нашем сайте';
            if($this->email) :
                $text = "Ваш логин: {$this->email}\r\n";
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
