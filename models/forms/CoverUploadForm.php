<?php
    namespace app\models\forms;
    use yii\base\Model;
    use yii\imagine\Image;

    class CoverUploadForm extends Model{
        public $cover;
        public $coverName;
        public $thumbName;

        public function rules(){
            return [
                [['cover'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 25000000],
            ];
        }

        public function upload($userId = null){
            if(is_null($userId)) $userId = \Yii::$app->user->getId();

            $tmpLabel = time();
            $this->coverName = '/web/storage/users_uploads/'.$userId.'/'.$tmpLabel.'.'.$this->cover->extension;
            $this->thumbName = '/web/storage/users_uploads/'.$userId.'/thumb_'.$tmpLabel.'.'.$this->cover->extension;
            if($this->validate()){
                if(!is_dir(\Yii::$app->basePath.'/web/storage/users_uploads/'.$userId)){
                    mkdir(\Yii::$app->basePath.'/web/storage/users_uploads/'.$userId, 0777);
                }
                $this->cover->saveAs(\Yii::$app->basePath.$this->coverName);
                Image::thumbnail(\Yii::$app->basePath.$this->coverName, 100, 100)
                     ->save(\Yii::$app->basePath.$this->thumbName);

                return true;
            }else{
                return false;
            }
        }
    }