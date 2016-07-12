<?php
    namespace app\models\forms;
    use yii\base\Model;

    class ConditionForm extends Model{
        public $isCount;
        public $countPerson;
        public $preEntry;
        public $discountSum;
        public $preCall;
        public $dispatcherCall;
        public $showCoupon;
        public $own;

        public function rules(){
            return [
                ['own', 'string', 'max'=> 255],
                ['countPerson', 'number', 'min' => 1, 'max' => 99]
            ];
        }

        public function scenarios(){
            return [
                'default' => ['isCount', 'countPerson', 'preEntry', 'discountSum', 'preCall', 'dispatcherCall', 'showCoupon', 'own']
            ];
        }
    }