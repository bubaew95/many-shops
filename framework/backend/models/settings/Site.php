<?php
namespace backend\models\settings;

use yii\base\Model;

class Site extends Model {

    public $siteName;
    public $siteDescription;
    public $siteKeywords;
    public $siteLogo;
    public $siteFavicon;

    public $selectSmtp;
    public $mailHost;
    public $mailPort;
    public $mailUsername;
    public $mailPassword;
    public $mailEncryption;

    public $countersHeader;
    public $countersFooter;

    public $phone;
    public $email;

    public function rules()
    {
        return [
            [['siteName'], 'required'],
            [
                [
                    'siteName', 'siteDescription', 'siteKeywords', 'siteLogo', 'siteFavicon',
                    'mailHost', 'mailUsername', 'mailPassword', 'countersHeader', 'countersFooter',
                    'phone', 'email', 'mailEncryption', 'selectSmtp'
                ],
                'string'
            ],
            [['mailPort'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'siteName' => 'Название сайта',
            'siteDescription' => 'Краткое описание',
            'siteKeywords' => 'Ключевые слова',
            'siteLogo' => 'Логотип',
            'siteFavicon' => 'Иконка для браузера',
            'mailHost' => 'Хост',
            'mailPort' => 'Порт',
            'mailUsername' => 'Логин',
            'mailPassword' => 'Пароль',
            'countersHeader' => 'Код в Header',
            'countersFooter' => 'Код в Footer',
            'phone' => 'Телефон',
            'email' => 'Эл.почта',
            'mailEncryption'=> 'Шифрование',
            'selectSmtp' => 'Тип отправки почты'
        ];
    }


}