<?php
    namespace app\models;
    use yii\db\ActiveRecord;

    class City extends ActiveRecord{
        public function rules(){
            return [
                ['name', 'unique', 'message' => 'Город уже существует'],
                ['name', 'required', 'message' => 'Поле является обязательным'],
                ['notGhost', 'boolean']
            ];
        }

        public static function tableName(){
            return '{{%city}}';
        }

        public function scenarios(){
            return [
                'default' => ['name', 'notGhost']
            ];
        }


        public function getUser(){
            return self::hasMany(User::className(), ['id' => 'cityId']);
        }

        public static function find()
        {
            return parent::find()->orderBy(self::tableName() . '.name');
        }
    }