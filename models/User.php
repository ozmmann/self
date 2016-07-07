<?php
    namespace app\models;

    use app\components\Email;
    use yii\db\ActiveRecord;
    use yii\helpers\BaseFileHelper;
    use yii\web\IdentityInterface;
    use yii;

    class User extends ActiveRecord implements IdentityInterface{
        public $username;
        public $emailMessage;
        public $cityName;
        public $stockTypeName;

        public function rules(){
            return [
                [['name', 'phone', 'stockTypeId', 'cityId'], 'required', 'message' => 'Поле является обязательным'],
                ['name', 'trim'],
                [['phone', 'secondPhone'], 'match', 'pattern' => '/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/'],
                ['site', 'url', 'defaultScheme' => ''],
                ['status', 'in', 'range' => ['ACTIVE', 'INACTIVE', 'BLOCKED']],
                ['inn', 'validINN'],
                ['inn', 'integer', 'message' => 'Не верный ИНН']
            ];
        }

        public function scenarios(){
            return [
                'default' => ['name', 'phone', 'secondPhone', 'stockTypeId', 'cityId', 'site', 'status', 'inn'],
            ];
        }


        public function afterFind(){
            $this->username = $this->name;

            $this->cityName = is_null($this->cityId) ? '' : City::findOne($this->cityId)->name;
            $this->stockTypeName = is_null($this->stockTypeId) ? '' : Stocktype::findOne($this->stockTypeId)->name;
        }

        public function beforeSave($insert){
            if($insert){
                $this->emailMessage = "Для входа используйте слеующие данные\r\n Логин: ".$this->email."\r\nПароль:".$this->password."\r\n";
                $this->password = Yii::$app->getSecurity()
                                           ->generatePasswordHash($this->password);
            }

            return true;
        }

        public function afterSave($insert, $changedAttributes){
            if($insert){
                $confirmLink = Yii::$app->getSecurity()
                                        ->generateRandomString();
                $confirm = new Confirm();
                $confirm->link = $confirmLink;
                $confirm->userId = $this->id;
                $confirm->sendDate = time();
                $confirm->save();

                $categoryStorage = '/web/storage/users_uploads/';
                BaseFileHelper::createDirectory(Yii::$app->basePath.$categoryStorage.$this->id);

                $createdUser = User::findOne($this->id);
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole($createdUser->getRole());
                $auth->assign($userRole, $createdUser->getId());
                
                $title = "ПЕРЕЙДИТЕ <br>НА СЛЕДУЮЩИЙ ШАГ";
                $link = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'confirm' => $confirmLink]);
                $body ="Перейдите на следующий шаг, чтобы подтвердить регистрацию.";

                Email::sendEmail(
                    'mail-template-html',
                    'Регистрация на Self Sevice для Pokupon&SuperDeal',
                    $title,
                    $link,
                    $body,
                    [Yii::$app->params['adminEmail'] => Yii::$app->name.' robot'],
                    $this->email
                );

                if(Yii::$app->user->login($createdUser, 0)){
                    return true;
                }
            }

            if(!$insert && isset($changedAttributes['status'])){
                $link = Yii::$app->urlManager->createAbsoluteUrl(['partner/index']);
                $status = Yii::$app->params['userStatus'][$this->status];
                $title = "Статус Вашего акаунта был изменен";
                $body = "Здравствуйте, статус Вашего акаунта был изменен модератором на <strong>{$status}</strong>";

                Email::sendEmail(
                    'mail-template-html',
                    Yii::$app->name.'. Изменен статус у Вашего акаунта.',
                    $title,
                    $link,
                    $body,
                    [Yii::$app->params['adminEmail'] => Yii::$app->name.' robot'],
                    $this->email
                );
            }
        }

        public static function findIdentity($id){
            return static::findOne($id);
        }

        public static function findByEmail($email){
            return self::findOne(['email' => $email]);
        }

        public static function findIdentityByAccessToken($token, $type = null){
        }

        public function getId(){
            return $this->id;
        }

        public function getRole(){
            return strtolower($this->role);
        }

        public function getStatus(){
            return strtolower($this->status);
        }

        public function getAuthKey(){
            return $this->auth_key;
        }

        /**
         * добавляем связь с таблицей City
         * @return yii\db\ActiveQuery
         */
        public function getCity(){
            return self::hasOne(City::className(), ['id' => 'cityId']);
        }

        public function getCityName(){
            $city = City::findOne(['id' => $this->cityId]);

            return $city->name;
        }

        public function getStockTypeName(){
            $stocktype = Stocktype::findOne(['id' => $this->stockTypeId]);

            return $stocktype->name;
        }

        /**
         * добавляем связь с таблицей Stocktype
         * @return yii\db\ActiveQuery
         */
        public function getStockType(){
            return self::hasOne(Stocktype::className(), ['id' => 'stockTypeId']);
        }

        public function validateAuthKey($authKey){
            return $this->getAuthKey() === $authKey;
        }

        public function validatePassword($password, $hash){
            return Yii::$app->getSecurity()
                            ->validatePassword($password, $hash);
        }

        public function validINN($attribute){

            if($this->make_inn_checksum($attribute) || $this->make_egrpou_checksum($attribute)){
                return true;
            }

            $this->addError($attribute, 'Не верный ИНН');

            return false;
        }

        private function make_inn_checksum($attribute){
            $result = 0;
            $inn = $this->$attribute;
            if(strlen($inn) == 10){
                $a1 = strval($inn)[0];
                $a2 = strval($inn)[1];
                $a3 = strval($inn)[2];
                $a4 = strval($inn)[3];
                $a5 = strval($inn)[4];
                $a6 = strval($inn)[5];
                $a7 = strval($inn)[6];
                $a8 = strval($inn)[7];
                $a9 = strval($inn)[8];
                $x = -1 * $a1 + 5 * $a2 + 7 * $a3 + 9 * $a4 + 4 * $a5 + 6 * $a6 + 10 * $a7 + 5 * $a8 + 7 * $a9;
                $result = ($x % 11) % 10;
            }

            if($result){
                return true;
            }

            return false;
        }

        private function make_egrpou_checksum($attribute)
        {
            $checksum = 0;
            $egrpou = $this->$attribute;
            if ($egrpou > 30000000 && $egrpou < 60000000) {
                foreach ([7, 1, 2, 3, 4, 5, 6] as $i => $k) {
                    if (isset($egrpou[$i])) {
                        $checksum += $k * $egrpou[$i];
                    } else {
                        return false;
                    }
                }
            } else {
                foreach ([7, 1, 2, 3, 4, 5, 6] as $i => $k) {
                    if (isset($egrpou[$i])) {
                        $checksum += $k * $egrpou[$i];
                    } else {
                        return false;
                    }
                }
            }

            if (($checksum % 11) >= 10) {
                $checksum = 0;
                if ($egrpou > 30000000 && $egrpou < 60000000) {
                    foreach ([9, 3, 4, 5, 6, 7, 8] as $i => $k) {
                        if(isset($egrpou[$i])) {
                            $checksum += $k * $egrpou[$i];
                        }else{
                            return false;
                        }
                    }
                } else {
                    foreach ([3, 4, 5, 6, 7, 8, 9] as $i => $k) {
                        if (isset($egrpou[$i])) {
                            $checksum += $k * $egrpou[$i];
                        } else {
                            return false;
                        }
                    }
                }

                return (($checksum % 11) < 10) ? ($checksum % 11) : 0;
            } else {
                return ($checksum % 11);//todo как-то не правильно ссчитает
            }
        }

    }
