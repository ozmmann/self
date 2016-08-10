<?php
    namespace app\models;

    use app\components\Email;
    use yii;
    use yii\db\ActiveRecord;

    /**
     * @property mixed startDate
     * @property mixed endDate
     */
    class Stock extends ActiveRecord{

        public $logo;
        public $site;

        public function scenarios(){
            return [
                'default' => ['id','categoryId', 'discount', 'commissionType', 'description', 'title', 'price', 'picture', 'startDate', 'endDate', 'link'],
            ];
        }

        public function rules(){
            return [
                ['link', 'url', 'message'=>'Не верный url']
            ];
        }

        public function afterFind(){
            $this->organizer = json_decode($this->organizer, true);
            $this->location = json_decode($this->location, true);
            $this->condition = json_decode($this->condition, true);
        }


        public static function findByUserId($id){
            $query = self::find();

            return $query->where([
                                     'userId' => User::find()
                                                     ->where(['id' => $id])
                                                     ->one()
                                 ]);
        }

        public function beforeSave($insert){
            if($insert){
                $this->commissionType = strtoupper($this->commissionType);
                $city = City::findOne(Yii::$app->user->identity->cityId);
                $cityType = ($city->notGhost) ? 'REGION' : 'GHOST';
                $commission = Commission::find()
                                        ->where(['stockCategoryId' => $this->categoryId])
                                        ->andWhere(['cityType' => $cityType])
                                        ->one();
                $commissionType = strtolower($this->commissionType);
                $this->commissionValue = $commission->$commissionType;
            }else{
                $this->commissionType = strtoupper($this->commissionType);
                $city = City::findOne(User::findOne($this->userId)->cityId);
                $cityType = ($city->notGhost) ? 'REGION' : 'GHOST';
                $commission = Commission::find()
                                        ->where(['stockCategoryId' => $this->categoryId])
                                        ->andWhere(['cityType' => $cityType])
                                        ->one();
                $commissionType = strtolower($this->commissionType);
                $this->commissionValue = $commission->$commissionType;
                if(is_array($this->condition)){
                    $this->condition = json_encode($this->condition);
                }
                if(is_array($this->organizer)){
                    $this->organizer = json_encode($this->organizer);
                }
                if(is_array($this->location)){
                    $this->location = json_encode($this->location);
                }
            }

            return true;
        }
        public function afterSave($insert, $changedAttributes)
        {
            if($insert){
                $moderators = User::find()->select(['email'])->where(['role'=>'MODERATOR'])->all();

                $title = 'НОВАЯ АКЦИЯ В СИСТЕМЕ';
                $link = Yii::$app->urlManager->createAbsoluteUrl(['moderator/stock', 'id' => $this->id]);
                $body ="Перейдите по ссылке, чтобы просмотреть детали.";

                $messages = [];

                foreach ($moderators as $moderator) {
                    $messages[] = Yii::$app->mailer->compose(
                            ['html' => 'mail-template-html'],
                            [
                                'title' => $title,
                                'link' => $link,
                                'body' => $body
                            ]
                        )
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($moderator->email)
                        ->setSubject(Yii::$app->name . '. Новая акция.');
                }

                Yii::$app->mailer->sendMultiple($messages);
            }

            return true;
        }

        public function createStock($stockForm, $conditionForm, $organizerForm, $locationForm){
            $this->attributes = $stockForm->attributes;
            $this->userId = Yii::$app->user->getId();
            $this->condition = json_encode($conditionForm->attributes);
            $this->organizer = json_encode($organizerForm->attributes);
            $this->location = json_encode($locationForm->attributes);

            return $this->save(false);
        }

        public function updateStock($stockForm, $conditionForm, $organizerForm, $locationForm){
            $this->attributes = $stockForm->attributes;
            $this->condition = json_encode($conditionForm->attributes);
            $this->organizer = json_encode($organizerForm->attributes);
            $this->location = json_encode($locationForm->attributes);

            return $this->save(false);
        }

        /**
         * @param $status
         *
         * @return bool
         * @throws \Swift_SwiftException
         */
        public function updateStatus($status){
            $oldStatus = $this->status;
            $newStatus = $status;
            $this->status = $status;
            if($oldStatus != $newStatus && $this->save(false)){
                $statuslabel = Yii::$app->params['stockStatus'][$status];
                /** @var User $user */
                $user = User::findOne($this->userId);
                $title = "Статус Вашей акции <br>был изменен";
                $link = Yii::$app->urlManager->createAbsoluteUrl(['partner/stock', 'id' => $this->id]);
                $body = "Здравствуйте, статус Вашей акции был изменен модератором на <strong>{$statuslabel}</strong>";

                Email::sendEmail('mail-template-html', Yii::$app->name.'. Изменен статус у Вашей акции.', $title, $link, $body, [Yii::$app->params['adminEmail'] => Yii::$app->name.' robot'], $user->email);

                return true;
            }

            return;
        }

        public function getUser(){
            return self::hasOne(User::className(), ['id' => 'userId']);
        }

        public function getStockCategory(){
            return self::hasOne(Stockcategory::className(), ['id' => 'categoryId']);
        }
    }