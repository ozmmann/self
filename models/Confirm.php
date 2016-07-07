<?php
    namespace app\models;
    use yii\db\ActiveRecord;
    use yii;
    use yii\helpers\Url;

    class Confirm extends ActiveRecord{
        public $emailMessage;
        public  function beforeDelete(){
            $moderators = User::find()->select(['email'])->where(['role'=>'MODERATOR'])->all();

            $this->emailMessage .= 'Новый пользователь в системе: '
                .Yii::$app->urlManager->createAbsoluteUrl(['moderator/partner', 'id' => $this->userId]);
            $messages = [];
            foreach ($moderators as $moderator) {
                $messages[] = Yii::$app->mailer->compose()
                                                ->setFrom(Yii::$app->params['adminEmail'])
                                                ->setTo($moderator->email)
                                                ->setSubject(Yii::$app->name . '. Новый пользователь.')
                                                ->setTextBody($this->emailMessage);
            }
            Yii::$app->mailer->sendMultiple($messages);

            return true;
        }

        public static function confirmEmail($link){
            $now = time();
            $confirmData = self::findOne(['link' => $link]);
            if(!is_null($confirmData) and ($confirmData->sendDate+3600*24) >= $now){
                $user = User::findOne(['id' => $confirmData->userId]);
                $user->confirmed = 1;
                $user->save(false);
                $confirmData->delete();

                if(Yii::$app->user->login($user, 0)){
                    return true;
                }

                return false;


            }
            return false;
        }
    }