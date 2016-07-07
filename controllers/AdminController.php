<?php
    namespace app\controllers;
    use app\models\City;
    use app\models\Commission;
    use app\models\forms\CommissionForm;
    use app\models\forms\EditCityForm;
    use app\models\forms\EditCommissionForm;
    use app\models\forms\EditStockCategory;
    use app\models\forms\EditUserForm;
    use app\models\Stock;
    use app\models\Stockcategory;
    use app\models\Stocktype;
    use app\models\User;
    use Yii;
    use yii\data\ActiveDataProvider;
    use yii\data\Pagination;
    use yii\web\Controller;
    use yii\filters\AccessControl;

    class AdminController extends Controller{
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ];
        }

        public function actions(){
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        public function actionIndex(){
            return $this->render('admin');
        }

        //region Commission
        public function actionCommissionList($nameSerch = null){
            $condition = '';
            if(!is_null($nameSerch)){
                $categoryIn = Stockcategory::find()
                                           ->where(['like', 'name', $nameSerch])
                                           ->select('id')
                                           ->asArray()
                                           ->all();

                $categoryIn = array_column($categoryIn, 'id');
                $condition = ['stockCategoryId' => $categoryIn];
            }

            $commissions = Commission::find()
                                     ->where($condition)
                                     ->all();

            return $this->render('commission_list', ['commissions' => $commissions]);
        }

        public function actionEditCommission($catId = null){

            $form = CommissionForm::getModels($catId);
            $insert = is_null($catId);
            if($form->load(Yii::$app->request->post()) && $form->saveCommissions($insert)){
                return $this->redirect('commission-list');
            }
            $categoryList = Stockcategory::getCategoryList();

            return $this->render('edit_commission', [
                'model'        => $form,
                'categoryList' => $categoryList
            ]);
        }
        //endregion

        //region City
        public function actionCityList($nameSerch = ''){
            $query = City::find()
                         ->where(['like', 'name', $nameSerch]);

            $pagination = new Pagination([
                                             'defaultPageSize' => 10,
                                             'totalCount'      => $query->count(),
                                         ]);

            $citys = $query->offset($pagination->offset)
                           ->limit($pagination->limit)
                           ->all();

            return $this->render('city_list', ['citys' => $citys, 'pagination' => $pagination]);
        }

        public function actionDeleteCity($id){
            City::deleteAll(['id' => $id]);

            return $this->redirect('city-list');
        }

        public function actionEditCity($id = null){

            $cityForm = City::findOne($id);
            if(is_null($cityForm)){
                $cityForm = new City();
            }

            if($cityForm->load(Yii::$app->request->post()) && $cityForm->save(true)){
                return $this->redirect('city-list');
            }

            return $this->render('edit_city', ['cityForm' => $cityForm]);
        }
        //endregion

        //region StockCategory
        public function actionStockCategoryList($id = 0, $subid = 0, $nameSerch = null){
            if(!is_null($nameSerch)){
                $model = Stockcategory::find()//                                      ->where(['not' => ['id' => 1]])
                                      ->where(['like', 'name', $nameSerch])
                                      ->all();
            }else{
                $model = Stockcategory::find()
                                      ->where(['parentId' => null])
                                      ->all();
            }
            $children = Stockcategory::find()
                                     ->where(['parentId' => $id])
                                     ->all();

            $subchildren = Stockcategory::find()
                                        ->where(['parentId' => $subid])
                                        ->all();

            return $this->render('stock_category_list', [
                'stockCategorys' => $model,
                'children'       => $children,
                'subchildren'    => $subchildren,
                'selectId'       => $id,
                'selSubId'       => $subid
            ]);
        }

        public function actionDeleteStockCategory($id){
            $stockCategory = Stockcategory::findOne($id);
            if(!$stockCategory->delete()){
                //todo  вывести сообщение что выбрана корневая папка
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        public function actionEditStockCategory($id = null){
            $model = Stockcategory::findOne($id);
            if(is_null($model)){
                $model = new Stockcategory();
            }

            if($model->load(Yii::$app->request->post()) && $model->saveCategory()){
                return $this->redirect('stock-category-list');
            }

            $categoryList = Stockcategory::getCategoryList();

            return $this->render('edit_stock_category', [
                'stockCategory' => $model,
                'categoryList'  => $categoryList,
                'isRoot'        => Stockcategory::isParent($id)
            ]);
        }
        //endregion
    }