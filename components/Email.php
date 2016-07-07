<?php
    namespace app\components;
    use Swift_SwiftException;
    use Yii;

    class Email{
        public static function sendEmail($emailTemplateName, $subject, $title, $link, $body, $fromEmail, $toEmail){
            try{
                Yii::$app->mailer->compose(
                    ['html' => $emailTemplateName],
                    [
                        'title' => $title,
                        'link' => $link,
                        'body' => $body
                    ])
                    ->setFrom($fromEmail)
                    ->setTo($toEmail)
                    ->setSubject($subject)
                    ->send();

                return true;
            }catch(Swift_SwiftException $e){
                throw new Swift_SwiftException('Письмо не отправлено');
            }
        }
    }