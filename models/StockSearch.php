<?php

    namespace app\models;

    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use yii\db\ActiveQuery;

    /**
     */
    class StockSearch extends Model{

        public $title;
        public $id;
        public $startDate;
        public $endDate;
        public $commissionType;
        public $status;
        public $userId;
        public $userName;
        public $userEmail;
        public $cityName;
        public $cityId;
        public $category;

        public function rules(){
            // only fields in rules() are searchable
            return [
                [['id', 'userId'], 'integer'],
                [['title', 'userName', 'userEmail', 'cityId', 'category', 'commissionType', 'status'], 'safe'],
            ];
        }

        public function scenarios(){
            // bypass scenarios() implementation in the parent class
            return Model::scenarios();
        }

        public function search($params){
            $query = Stock::find()
                          ->alias('st')
                          ->with(['user', 'stockCategory']);

            // add conditions that should always apply here
            $dataProvider = new ActiveDataProvider([
                                                       'query'      => $query,
                                                       'pagination' => [
                                                           'pageSize' => 20,
                                                       ]
                                                   ]);

            if(!($this->load($params) && $this->validate())){

                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                                       'id'        => $this->id,
                                       'userId'    => $this->userId,
                                       'st.status' => $this->status,
                                   ]);
            $query->andFilterWhere(['like', 'title', trim($this->title)]);
            $query->andFilterWhere(['startDate' => $this->startDate]);
            $query->andFilterWhere(['commissionType' => $this->commissionType]);
            $query->andFilterWhere(['categoryId' => $this->category]);

            $query->joinWith([
                                 'user u' => function(ActiveQuery $q){
                                     $q->where(['like', 'u.name', $this->userName]);
                                 }
                             ]);

            //['like', 'u.email', $this->userEmail])->andWhere(
            if(!empty($this->cityId)){
                $query->joinWith(['user.city c'])
                      ->where(['c.id' => $this->cityId]);
            }

            return $dataProvider;
        }
    }