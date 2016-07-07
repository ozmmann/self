<?php
    namespace app\models\forms;

    use app\models\User;
    use yii\base\Model;
    use yii;

    class LoginForm extends Model{
        public $login;
        public $password;
        public $rememberMe = false;

        public function rules(){
            return [
                [['login', 'password'], 'required', 'message' => 'Поле является обязательным'],
                ['login', 'email'],
                ['password', 'validatePassword'],
                ['rememberMe', 'boolean'],
            ];
        }

        public function validatePassword($attribute, $params){
            if(!$this->hasErrors()){
                $user = User::findByEmail($this->login);
                if(!$user or !$user->validatePassword($this->password, $user->password)){
                    $this->addError($attribute, 'Incorrect Email or Password!');
                }
            }
        }
        
        public function isConfirmed(){
            $user = User::findByEmail($this->login);
            if($user->confirmed){
                return true;
            }
            $this->addError('login', 'Account is not confirmed!');
            return false;
        }
        
        public function login(){
            if($this->validate()){
                return Yii::$app->user->login(User::findByEmail($this->login), $this->rememberMe ? 3600*24*30 : 0);
            }
            return false;
        }
    }