<?php
    namespace app\models\forms;
    use yii\base\Model;

    class LogoUploadForm extends Model{
        public $logo;
        public $logoName;

        public function rules(){
            return [
                [['logo'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 200000],
            ];
        }

        public function upload($userId = null){
            if(is_null($userId)) $userId = \Yii::$app->user->getId();
            $tmpLabel = 'logo_'.time();
            $this->logoName = '/web/storage/users_uploads/'.$userId.'/logos/'.$tmpLabel.'.'.$this->logo->extension;
            if($this->validate()){
                if(!is_dir(\Yii::$app->basePath.'/web/storage/users_uploads/'.$userId.'/logos')){
                    mkdir(\Yii::$app->basePath.'/web/storage/users_uploads/'.$userId.'/logos', 0777);
                }
                $this->logo->saveAs(\Yii::$app->basePath.$this->logoName);

                return true;
            }else{
                return false;
            }
        }
    }