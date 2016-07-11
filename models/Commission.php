<?php
    namespace app\models;
    use yii;
    use yii\db\ActiveRecord;

    /**
     * @property mixed stockCategoryId
     * @property mixed id
     * @property mixed percent
     * @property mixed fixed
     * @property mixed free
     * @property mixed cityType
     */
    class Commission extends ActiveRecord{
        public $categoryName;


        public function rules(){
            return [
                [['cityType', 'stockCategoryId'], 'required'],
                ['cityType', 'in', 'range' => ['REGION', 'GHOST']],
                [['percent','fixed','free'], 'safe'],
            ];
        }

        public function afterFind(){
            if(!empty(Stockcategory::findOne($this->stockCategoryId))){
                $this->categoryName = Stockcategory::findOne($this->stockCategoryId)->name;
            }
        }

        /**
         * @param $userId
         * @param $categoryId
         * @param $discount
         *
         * @return array|bool
         */
        public static function getAllocationTypes($userId, $categoryId, $discount){
            $user = User::findOne($userId);
            $cityType = City::findOne(['id' => $user->cityId])->notGhost;
            if($cityType){
                $cityType = 'REGION';
            }else{
                $cityType = 'GHOST';
            }
            $commission = self::find()
                              ->where(['cityType' => $cityType])
                              ->andWhere(['stockCategoryId' => $categoryId])
                              ->one();

            $allocationTypes = [];
            if($commission && !is_null($commission->free) && $discount >= $commission->free){
                $allocationTypes['FREE']['name'] = 'Я размещаюсь бесплатно за высокий % скидки в моей категории';
                $allocationTypes['FREE']['value'] = $commission->free;
            }

            if($commission && !is_null($commission->fixed)){
                $allocationTypes['FIXED']['name'] = 'Я плачу фиксированную ставку';
                $allocationTypes['FIXED']['value'] = $commission->fixed;
            }

            if($commission && !is_null($commission->percent)){
                $allocationTypes['PERCENT']['name'] = 'Я плачу коммисиию за продажу';
                $allocationTypes['PERCENT']['value'] = $commission->percent;
            }

            return empty($allocationTypes) ? false : $allocationTypes;
        }
        public static function getAllocationTypesList($userId, $categoryId, $discount){
            $user = User::findOne($userId);
            $cityType = City::findOne(['id' => $user->cityId])->notGhost;
            if($cityType){
                $cityType = 'REGION';
            }else{
                $cityType = 'GHOST';
            }
            $commission = self::find()
                              ->where(['cityType' => $cityType])
                              ->andWhere(['stockCategoryId' => $categoryId])
                              ->one();

            $allocationTypes = [];
            if($commission && !is_null($commission->free) && $discount >= $commission->free){
                $allocationTypes['FREE']/*['name']*/ = 'Я размещаюсь бесплатно за высокий % скидки в моей категории';
//                $allocationTypes['FREE']['value'] = $commission->free;
            }

            if($commission && !is_null($commission->fixed)){
                $allocationTypes['FIXED']/*['name']*/ = 'Я плачу фиксированную ставку';
//                $allocationTypes['FIXED']['value'] = $commission->fixed;
            }

            if($commission && !is_null($commission->percent)){
                $allocationTypes['PERCENT']/*['name']*/ = 'Я плачу коммисиию за продажу';
//                $allocationTypes['PERCENT']['value'] = $commission->percent;
            }

            return empty($allocationTypes) ? false : $allocationTypes;
        }


    }