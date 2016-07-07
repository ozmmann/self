<?php
    namespace app\models\forms;
    use app\models\User;
    use yii\base\Model;

    class EditUserForm11 extends Model{
        public $name;
        public $phone;
        public $secondPhone;
        public $stockTypeId;
        public $cityId;
        public $site;
        public $status;
        public $inn;


        public function __construct($id){

            $user = User::find()
                        ->where(['id' => $id])
                        ->andWhere(['not', ['role' => 'MODERATOR']])
                        ->one();
            if(is_null($user)){
                return false;
            }
            parent::__construct();
            $userAttr = array_keys($user->attributes);
            $formAttr = array_keys($this->attributes);
            foreach($formAttr as $item){
                if(in_array($item, $userAttr)){
                    $this->$item = $user->$item;
                }
            }
        }

    }