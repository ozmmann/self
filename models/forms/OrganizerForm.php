<?php
    namespace app\models\forms;
    use yii\base\Model;

    class OrganizerForm extends Model{
        public $name;
        public $phone;
        public $site;
        public $logo;

        public function rules(){
            return[
                ['name', 'required'],
                ['phone', 'match', 'pattern' => '/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/'],
                ['site', 'url', 'defaultScheme' => 'http']
            ];
        }

        public function scenarios(){
            return[
                'default' => ['name', 'phone', 'site', 'logo'],
            ];
        }
    }
