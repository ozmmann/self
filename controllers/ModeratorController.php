<?php
    namespace app\controllers;
    use app\assets\CustomAsset;
    use app\models\City;
    use app\models\Commission;
    use app\models\forms\EditCommissionForm;
    use app\models\forms\EditUserForm;
    use app\models\Stock;
    use app\models\Stockcategory;
    use app\models\StockSearch;
    use app\models\Stocktype;
    use app\models\User;
    use app\models\UserSearch;
    use Yii;
    use yii\bootstrap\BootstrapAsset;
    use yii\data\ActiveDataProvider;
    use yii\data\Pagination;
    use yii\helpers\ArrayHelper;
    use yii\web\AssetBundle;
    use yii\web\AssetManager;
    use yii\web\Controller;
    use yii\filters\AccessControl;
    use app\models\forms\ConditionForm;
    use app\models\forms\CoverUploadForm;
    use app\models\forms\LogoUploadForm;
    use app\models\forms\LocationForm;
    use app\models\forms\OrganizerForm;
    use app\models\forms\StockForm;
    use yii\web\UploadedFile;

    class ModeratorController extends Controller{
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['moderator'],
                        ],
                    ],
                ],
            ];
        }

        public function beforeAction($action)
        {
            BootstrapAsset::register($this->getView());
            return parent::beforeAction($action);
        }

        public function actions(){
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        public function actionIndex(){
            Yii::$app->formatter->locale = 'ru-RU';

            $partnerProvider = new ActiveDataProvider([
                                                          'query'      => User::find()
                                                                              ->with(['city', 'stockType'])
                                                                              ->where([
                                                                                          'role'   => 'PARTNER',
                                                                                          'status' => 'INACTIVE'
                                                                                      ]),
                                                          'pagination' => [
                                                              'pageSize' => 3,
                                                          ],
                                                      ]);
            $stockProvider = new ActiveDataProvider([
                                                        'query'      => Stock::find()
                                                                             ->where([
                                                                                         'status' => 'INACTIVE'
                                                                                     ]),
                                                        'pagination' => [
                                                            'pageSize' => 3,
                                                        ],
                                                    ]);

            return $this->render('dashboard', ['partnerProvider' => $partnerProvider, 'stockProvider' => $stockProvider]);
        }

        //region Partner
        public function actionPartner($id){
            $partner = User::findOne($id);

            return $this->render('partner', ['partner' => $partner]);
        }

        public function actionPartnerList(){
            $searchModel = new UserSearch();
            $partnerProvider = $searchModel->search(Yii::$app->request->queryParams);

            $cityList = ArrayHelper::map(City::find()
                                             ->all(), 'id', 'name');
            $stockTypeList = ArrayHelper::map(Stocktype::find()
                                                       ->all(), 'id', 'name');

            return $this->render('partner_grid', [
                'partnerProvider' => $partnerProvider,
                'searchModel'     => $searchModel,
                'cityList'        => $cityList,
                'stockTypeList'   => $stockTypeList
            ]);
        }

        public function actionEditPartner($id = null){
            $model = User::find()
                         ->where(['id' => $id])
                         ->andWhere(['not', ['role' => 'MODERATOR']])
                         ->one();
            if(is_null($model)){
                return $this->render('denied');
            }

            if($model->load(Yii::$app->request->post()) && $model->save(true)){
                return $this->redirect('index');
            }

            if(is_null($id)){
                $model = new User();
            }
            $stockTypeList = Stocktype::find()
                                      ->all();
            $cityList = City::find()
                            ->all();

            return $this->render('edit_partner', ['partnerForm' => $model, 'stockTypeList' => $stockTypeList, 'cityList' => $cityList]);
        }

        public function actionDeletePartner($id){
            User::deleteAll(['id' => $id]);

            return $this->redirect(Yii::$app->request->referrer);
        }

        //endregion

        //region Stock
        public function actionStock($id){
            $stock = Stock::findOne($id);

            return $this->render('stock', ['stock' => $stock]);
        }

        public function actionStockList(){
            $searchModel = new StockSearch();
            $stockProvider = $searchModel->search(Yii::$app->request->queryParams);
            $cityList = ArrayHelper::map(City::find()
                                             ->all(), 'id', 'name');

            $categoryList = Stockcategory::getCategoryList();

            return $this->render('stock_list', [
                'stockProvider' => $stockProvider,
                'searchModel'   => $searchModel,
                'cityList'      => $cityList,
                'categoryList'  => $categoryList
            ]);
        }

        public function actionDeleteStock($id){
            Stock::deleteAll(['id' => $id]);

            return $this->redirect(Yii::$app->request->referrer);
        }

        public function actionEditStock($id){
            $stock = Stock::findOne($id);
            $partner = User::findOne($stock->userId);
            $stockCategoryList = Stockcategory::getCategoryList();

            if(Yii::$app->request->isAjax){
                switch(Yii::$app->request->post('get')){
                    case'allocationTypes':
                        $options = Commission::getAllocationTypes($stock->userId, Yii::$app->request->post('categoryId'), Yii::$app->request->post('discount'));
                        Yii::$app->response->format = 'json';

                        return $options;
                        break;
                    case'categoryCovers':
                        $covers = [];
                        $categoryStorage = '/web/storage/default_category_images/'.Yii::$app->request->post('categoryId').'/';
                        $defaultCategory = new \DirectoryIterator(Yii::$app->basePath.$categoryStorage);
                        foreach($defaultCategory as $cover){
                            if($cover->isDot() or $cover->isDir()){
                                continue;
                            }

                            $covers[] = $categoryStorage.$cover->getFilename();
                        }
                        $userStorage = '/web/storage/users_uploads/'.$stock->userId.'/';
                        $userCovers = new \DirectoryIterator(Yii::$app->basePath.$userStorage);
                        foreach($userCovers as $cover){
                            if($cover->isDot() or $cover->isDir()){
                                continue;
                            }

                            $covers[] = $userStorage.$cover->getFilename();
                        }
                        Yii::$app->response->format = 'json';

                        return $covers;
                        break;
                }

                if(Yii::$app->request->isPost && Yii::$app->request->post('upload') == 1){
                    $model = new CoverUploadForm();

                    $model->cover = UploadedFile::getInstance($model, 'cover');
                    if($model->upload($stock->userId)){
                        return $model->thumbName;
                    }

                    return 'error';
                }

                if(Yii::$app->request->isPost && Yii::$app->request->post('uploadLogo') == 1){
                    $model = new LogoUploadForm();

                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    if($model->upload($stock->userId)){
                        return $model->logoName;
                    }

                    return 'error';
                }
                if(Yii::$app->request->isPost && Yii::$app->request->post('updateStatus') == 1){
                    $stock->updateStatus(Yii::$app->request->post('status'));

                    return 'ok';
                }
            }
            $stockForm = new StockForm($stock);
            $conditionForm = new ConditionForm($stock->condition);
            $organizerForm = new OrganizerForm($stock->organizer);
            $locationForm = new LocationForm($stock->location);

            $categoryCovers = Stockcategory::getCategoryCovers($stock->categoryId, $stock->userId);
            $commissionTypes = Commission::getAllocationTypes($stock->userId, $stock->categoryId, $stock->discount);

            if($stockForm->load(Yii::$app->request->post()) && $conditionForm->load(Yii::$app->request->post()) && $organizerForm->load(Yii::$app->request->post()) && $locationForm->load(Yii::$app->request->post())){
                $validationStatus = $stockForm->validate();
                $validationStatus = $organizerForm->validate() && $validationStatus;
                $validationStatus = $conditionForm->validate() && $validationStatus;
                $validationStatus = $locationForm->validate() && $validationStatus;
                if($validationStatus){

                    if($stock->updateStock($stockForm, $conditionForm, $organizerForm, $locationForm)){
                        $this->redirect(['moderator/stock', 'id' => $stock->id]);
                    }
                }
            }

            return $this->render('edit_stock', [
                //                'stock'             => $stock,
                //                'partner'           => $partner,
                'stockForm'         => $stockForm,
                'conditionForm'     => $conditionForm,
                'organizerForm'     => $organizerForm,
                'locationForm'      => $locationForm,
                'stockCategoryList' => $stockCategoryList,
                //                'categoryCovers'    => $categoryCovers,
                'commissionTypes'   => $commissionTypes
            ]);
        }

        //endregion

        public function actionProfile(){
            $moderator = Yii::$app->user->identity;

            return $this->render('profile', ['moderator' => $moderator]);
        }

        public function actionEmailError(){
            return $this->render('emailerror');
        }

    }