<?php

namespace app\components;

use Exception;
use Yii;
use yii\base\BaseObject;

class Notifier extends BaseObject
{
    const METHOD_EMAIL = 'email';
    const METHOD_SMS = 'sms';

    public $emailFrom;
    public $emailTo;
    public $phoneTo;
    public $method = self::METHOD_EMAIL;

    public function send($title, $message)
    {
        switch ($this->method) {
            case self::METHOD_EMAIL:
                $this->sendEmail($title, $message);
                break;
            case self::METHOD_SMS:
                $this->sendSms($title, $message);
                break;
            default:
                Yii::error("Ошибочный метод уведомлений: {$this->method}");
        }
    }

    public function sendEmail($subject, $body)
    {
        try {
            $email = Yii::$app->mailer->compose()
                ->setFrom($this->emailFrom)
                ->setTo($this->emailTo)
                ->setSubject($subject)
                ->setTextBody(strip_tags($body))
                ->setHtmlBody($body);

            if (!$email->send()) {
                throw new Exception('Не удалось отправить письмо');
            }
        } catch (Exception $e) {
            Yii::error([$e->getMessage(), $subject, $body]);
        }
    }

    public function sendSms($subject, $body)
    {
        Yii::error('Метод не реализован.');
    }
}
