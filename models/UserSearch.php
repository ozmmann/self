<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

    /**
     * @property mixed id
     */
    class UserSearch extends User{
        public $id;
        public $name;
        //        public $cityName;
        public $status;
        public $cityId;
        public $stockTypeId;


        public function rules(){
            return [
                [['id', 'cityId'], 'integer'],
                [['name', 'status', 'stockTypeId'], 'safe'],
            ];
        }

        public function scenarios(){
            return Model::scenarios();
        }

        public function search($params){
            $query = User::find()
                         ->where(['role' => 'PARTNER']);

            $dataProvider = new ActiveDataProvider([
                                                       'query'      => $query,
                                                       'pagination' => [
                                                           'pageSize' => 3,
                                                       ],
                                                       'sort'       => [
                                                           'attributes' => [
                                                               'name'          => [
                                                                   'asc'  => ['name' => SORT_ASC],
                                                                   'desc' => ['name' => SORT_DESC]
                                                               ],
                                                               'email'         => [
                                                                   'asc'  => ['email' => SORT_ASC],
                                                                   'desc' => ['email' => SORT_DESC]
                                                               ],
                                                               'status'        => [
                                                                   'asc'  => ['status' => SORT_ASC],
                                                                   'desc' => ['status' => SORT_DESC]
                                                               ],
//                                                               'stockTypeName' => [
//                                                                   'asc'  => ['stockTypeName' => SORT_ASC],
//                                                                   'desc' => ['stockTypeName' => SORT_DESC]
//                                                               ],
                                                               'cityId'        => [
                                                                   'asc'  => ['ss_city.name' => SORT_ASC],
                                                                   'desc' => ['ss_city.name' => SORT_DESC]
                                                               ],
                                                           ]
                                                       ]
                                                   ]);;

            if(!($this->load($params) && $this->validate())){

                $query->joinWith(['city', 'stockType']);

                return $dataProvider;
            }

            $query->andFilterWhere(['id' => $this->id,]);
            $query->andFilterWhere(['cityId' => $this->cityId,]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['stockTypeId' => $this->stockTypeId]);

            $query->andFilterWhere(['like', 'name', $this->name]);

            return $dataProvider;
        }
    }
