<?php
    namespace app\models\forms;

    use yii\base\Model;

    class LocationForm extends Model{
        public $city;
        public $address;
        public $phone;


        public function rules(){
            return [
                [['city', 'address', 'phone',], 'safe'],
                //                ['phone', 'match', 'pattern' => '/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/'],
            ];
        }

        public function scenarios(){
            return [
                'default' => [
                    'city',
                    'address',
                    'phone',
                ]
            ];
        }
    }