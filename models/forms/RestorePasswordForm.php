<?php
    namespace app\models\forms;
    use app\components\Email;
    use app\models\Restore;
    use app\models\User;
    use Yii;
    use yii\base\Model;

    class RestorePasswordForm extends Model{
        public $email;

        public function rules(){
            return [
                ['email', 'trim'],
                ['email', 'required', 'message' => 'Поле является обязательным'],
                ['email', 'email'],
                ['email', 'exist',
                 'targetClass' => 'app\models\User',
                 'message' => 'There is no user with such email.'
                ],
            ];
        }

        public function sendEmail(){
            $user = User::findOne([
                                      'email' => $this->email,
                                  ]);

            if (!$user) {
                return false;
            }

            if($restore = Restore::findOne(['userId' => $user->getId()])){
                $restoreLink = $restore->link;
            } else {
                $restoreLink = Yii::$app->getSecurity()
                                        ->generateRandomString();
                $restore = new Restore();
                $restore->link = $restoreLink;
                $restore->userId = $user->getId();
                $restore->sendDate = time();
                $restore->save();
            }

            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/restore-password', 'token' => $restoreLink]);
            $title = "Восстановление пароля";
            $body = "Для восстановления вашего пароля пройдите по ссылке выше";

            if(Email::sendEmail(
                'mail-template-html',
                Yii::$app->name . '. Восстановление пароля для ',
                $title,
                $resetLink,
                $body,
                [Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'],
                $this->email
            )){
                return true;
            }

        }
    }