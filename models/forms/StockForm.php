<?php

    namespace app\models\forms;
    use yii\base\Model;

    class StockForm extends Model{
        public $id;
        public $userId;
        public $categoryId;
        public $discount;
        public $commissionType;
        public $commissionValue;
        public $status;
        public $title;
        public $description;
        public $price;
        public $picture;

        public $startDate;
        public $endDate;

        public $condition;
        public $organizer;
        public $location;

        public function rules(){
            return [
                [
                    ['categoryId', 'discount', 'commissionType', 'title', 'description', 'price', 'startDate', 'endDate', 'picture'],
                    'required',
                    'message' => 'Поле является обязательным'
                ],
                ['discount', 'number', 'min' => 1, 'max' => 100],
                ['title', 'string', 'min' => 8, 'max' => 255],
                ['price', 'number', 'min' => 1, 'max' => 999999]
            ];
        }

        public function scenarios(){
            return [
                'default' => [
                    'id',
                    'userId',
                    'categoryId',
                    'discount',
                    'commissionType',
                    'commissionValue',
                    'status',
                    'title',
                    'description',
                    'price',
                    'picture',
                    'startDate',
                    'endDate'
                ],
            ];
        }
    }