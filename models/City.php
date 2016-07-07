<?php
    namespace app\models;
    use yii\db\ActiveRecord;

    class City extends ActiveRecord{
        public function rules(){
            return [
                ['name', 'match', 'pattern' => '/[a-zа-яA-ZА-Я]+$/s'],
                ['name', 'unique', 'message' => 'Город уже существует'],
                ['name', 'required', 'message' => 'Поле является обязательным'],
                ['notGhost', 'boolean']
            ];
        }

        public function scenarios(){
            return [
                'default' => ['name', 'notGhost']
            ];
        }


        public function getUser(){
            return self::hasMany(User::className(), ['id' => 'cityId']);
        }
    }