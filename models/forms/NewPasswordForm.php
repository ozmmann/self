<?php
    namespace app\models\forms;
    use app\components\Email;
    use app\models\Restore;
    use app\models\User;
    use Yii;
    use yii\base\Model;

    class NewPasswordForm extends Model{
        public $password;

        public function rules(){
            return [
                ['password', 'trim'],
                ['password', 'required', 'message' => 'Поле является обязательным'],
            ];
        }
    }