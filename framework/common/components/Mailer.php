<?php
namespace common\components;

use common\traits\HelperTrait;
use Swift_RfcComplianceException;
use Swift_TransportException;
use Yii;
use yii\base\Exception;
use yii\base\Widget;

class Mailer
{

    public $adminEmail;

    public $settings;

    public function __construct()
    {
        $this->settings = Yii::$app->settings;

        $smtpSettings = [
            'class'             => 'yii\swiftmailer\Mailer',
            'useFileTransport'  => true,
            'viewPath'          => '@common/mail',
        ];

        if($this->settings->get('Site.selectSmtp') == 'true'):
            $this->adminEmail = $this->settings->get('Site.mailUsername');
            $smtpSettings['useFileTransport'] = false;
            $smtpSettings['transport'] =[
                'class'      => 'Swift_SmtpTransport',
                'host'       => $this->settings->get('Site.mailHost'),
                'port'       => $this->settings->get('Site.mailPort'),
                'username'   => $this->adminEmail,
                'password'   => $this->settings->get('Site.mailPassword'),
                'encryption' => $this->settings->get('Site.mailEncryption'),
            ];
        endif;

        Yii::$app->setComponents( ['mailer' => $smtpSettings] );
    }

    /**
     * @param $email
     * @param $subject
     * @param string $model
     * @return \yii\mail\MessageInterface
     */
    public function send($email, $subject, $model = '')
    {
        $mail = null;
        try {
            $mail = Yii::$app->mailer;
            $mail = is_array($model) ? $mail->compose($model[0], $model[1]) : $mail->compose();

            $mail->setTo($email)
                ->setFrom([$this->adminEmail => mb_strtoupper(HelperTrait::domain(1)) . ' робот'])
                ->setSubject($subject );

            if(is_string($model)) $mail->setTextBody($model);
            $mail->send();
        }
        catch(Swift_TransportException $e) {}
        catch(Swift_RfcComplianceException $e) {}

        return $mail;
    }

}