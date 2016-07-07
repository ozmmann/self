<?php
    namespace app\models;
    use app\components\Email;
    use Yii;
    use yii\db\ActiveRecord;

    class Restore extends ActiveRecord{

        public $emailMessage;
        private static $newPassword;

        public  function afterDelete(){
            $restoreData = self::getAttributes();
            $user = User::findOne($restoreData['userId']);
            $newPassword = self::$newPassword;
            $loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
            $title = "ВОССТАНОВЛЕНИЕ ПАРОЛЯ";
            $body = "Уважаемый, $user->name <br>";
            $body .= "Ваш новый пароль: $newPassword <br>";
            $body .= "Чтобы войти пройдите по ссылке и воспользуйтесь Вашим email'ом и новым паролем <br>";

            Email::sendEmail(
                'mail-template-html',
                Yii::$app->name . '. Восстановление пароля.',
                $title,
                $loginLink,
                $body,
                [Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'],
                $user->email
            );

            return true;
        }

        public static function restorePassword($token){
            $now = time();
            $restoreData = self::findOne(['link' => $token]);

            if(!is_null($restoreData) and ($restoreData->sendDate+3600*24) >= $now){
                $user = User::findOne(['id' => $restoreData->userId]);

                self::$newPassword = Yii::$app->getSecurity()
                                           ->generateRandomString(8);
                $restoreData->delete();
                $user->password = Yii::$app->getSecurity()
                                           ->generatePasswordHash(self::$newPassword);
                $user->save(false);

                return true;


            }
            return false;
        }

    }