<?php
    namespace app\models\forms;
    use app\models\User;
    use Yii;
    use yii\base\Model;
    use yii\helpers\BaseFileHelper;

    class RegistrationForm extends Model{
        public $email;
        public $password;
        public $password_repeat;
        public $name;
        public $phone;
        public $secondPhone;
        public $stockTypeId;
        public $cityId;
        public $agree = true;
        public $site;

        public function rules(){
            return [
                [
                    ['email', 'password', 'password_repeat', 'name', 'phone', 'stockTypeId', 'cityId', 'agree'],
                    'required',
                    'message' => 'Поле является обязательным'
                ],
                [['email', 'password', 'password_repeat', 'name'], 'trim'],
                ['agree', 'boolean'],
                ['email', 'email', 'message' => 'Значение не является правильным email адресом.'],
                ['email', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email', 'message' => 'Такой пользователь уже существует'],
                ['password', 'compare', 'message' => 'Пароли не совпадают'],
                [['phone', 'secondPhone'], 'match', 'pattern' => '/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/', 'message' => 'Не верный телефон'],
                ['site', 'url', 'defaultScheme' => '', 'message' => 'Значение не является правильным URL'],
                ['agree', 'compare', 'compareValue'=>1, 'operator'=> '==', 'message'=>'Поле является обязательным']
            ];
        }

        public function registration(){
            if($this->validate()){

                $user = new User();
                $userAttr = array_keys($user->attributes);
                $formAttr = array_keys($this->attributes);
                foreach($userAttr as $item){
                    if(in_array($item, $formAttr)){
                        $user->$item = $this->$item;
                    }
                }

                if($user->save()){
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('partner');
                    $auth->assign($authorRole, $user->getId());


                    return true;
                }
            }
            return false;
        }
    }