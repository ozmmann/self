<?php
    namespace app\controllers;
    use app\assets\CustomAsset;
    use app\components\Email;
    use app\models\Commission;
    use app\models\Confirm;
    use app\models\forms\ConditionForm;
    use app\models\forms\CoverUploadForm;
    use app\models\forms\LogoUploadForm;
    use app\models\forms\LocationForm;
    use app\models\forms\OrganizerForm;
    use app\models\forms\StockForm;
    use app\models\Stock;
    use app\models\Stockcategory;
    use app\models\User;
    use Yii;
    use yii\data\Pagination;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\filters\AccessControl;

    class PartnerController extends Controller{
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['partner'],
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

        public function actionIndex($order = null){
            if(!$this->isConfirmed()){
                return $this->render('index_not_confirmed');
            }

            if(Yii::$app->user->identity->getStatus() != 'active'){
                return $this->render('success_page');
            }

            $query = Stock::findByUserId(Yii::$app->user->getId())
                          ->orderBy($order);

            $pagination = new Pagination([
                                             'defaultPageSize' => 10,
                                             'totalCount'      => $query->count(),
                                         ]);

            $stocks = $query->offset($pagination->offset)
                            ->limit($pagination->limit)
                            ->all();

            return $this->render('stock_list', ['stocks' => $stocks, 'pagination' => $pagination]);
        }

        public function actionProfile(){
            $partner = Yii::$app->user->identity;

            return $this->render('profile', ['partner' => $partner]);
        }

        public function actionCreateStock(){
            if(Yii::$app->user->identity->getStatus() != 'active'){
                return $this->render('success_page');
            }
            if(Yii::$app->request->isAjax){
                switch(Yii::$app->request->post('get')){
                    case'allocationTypes':
                        $options = Commission::getAllocationTypes(Yii::$app->user->getId(), Yii::$app->request->post('categoryId'), Yii::$app->request->post('discount'));
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
                        $userStorage = '/web/storage/users_uploads/'.Yii::$app->user->getId().'/';
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
                    if($model->upload()){
                        return $model->thumbName;
                    }

                    return 'error';
                }

                if(Yii::$app->request->isPost && Yii::$app->request->post('uploadLogo') == 1){
                    $model = new LogoUploadForm();

                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    if($model->upload()){
                        return $model->logoName;
                    }

                    return 'error';
                }
            }

            $stockForm = new StockForm();
            $conditionForm = new ConditionForm();
            $organizerForm = new OrganizerForm();
            $locationForm = new LocationForm();
            //            return var_dump(Yii::$app->request->post());
            if($stockForm->load(Yii::$app->request->post()) && $conditionForm->load(Yii::$app->request->post()) && $organizerForm->load(Yii::$app->request->post()) && $locationForm->load(Yii::$app->request->post())){
                $validationStatus = $stockForm->validate();
                $validationStatus = $organizerForm->validate() && $validationStatus;
                $validationStatus = $conditionForm->validate() && $validationStatus;
                $validationStatus = $locationForm->validate() && $validationStatus;
                if($validationStatus){
                    $stock = new Stock();

                    if($stock->createStock($stockForm, $conditionForm, $organizerForm, $locationForm)){
                        $this->redirect(['partner/index']);
                    }
                }
            }

            $stockCategoryList = Stockcategory::getCategoryList();

            return $this->render('stock_form', [
                'stockForm'         => $stockForm,
                'conditionForm'     => $conditionForm,
                'organizerForm'     => $organizerForm,
                'locationForm'      => $locationForm,
                'stockCategoryList' => $stockCategoryList,
            ]);
        }

        public function isConfirmed(){
            $user = Yii::$app->user;
            if($user->identity->confirmed){
                return true;
            }

            return false;
        }


        public function actionResendConfirm(){
            $user = Yii::$app->user->identity;
            $confirm = Confirm::findOne(['userId' => $user->id]);
            if(is_null($confirm)){
                $confirmLink = Yii::$app->getSecurity()
                    ->generateRandomString();
                $confirm = new Confirm();
                $confirm->link = $confirmLink;
                $confirm->userId = $user->id;
            }
            else if($confirm->sendDate + 3600 > time()){
                return $this->render('index_not_confirmed', ['confirmDate' => $confirm->sendDate, 'alreadySend' => true]);
            }

            $confirm->sendDate = time();
            $confirm->save(false);

            $link = Yii::$app->urlManager->createAbsoluteUrl([
                                                                 'site/confirm',
                                                                 'confirm' => $confirm->link,
                                                             ]);
            $title = "ПЕРЕЙДИТЕ <br>НА СЛЕДУЮЩИЙ ШАГ";

            $body ="Перейдите на следующий шаг, чтобы подтвердить Ваш email.";

            Email::sendEmail(
                'mail-template-html',
                'Регистрация на Self Sevice для Pokupon&SuperDeal',
                $title,
                $link,
                $body,
                [Yii::$app->params['adminEmail'] => Yii::$app->name.' robot'],
                $user->email
            );

            return $this->render('resend_confirm_success');
        }

        public function actionStock($id){
            $stock = Stock::findOne($id);

            return $this->render('stock', ['stock' => $stock]);
        }

        //todo delete after dev
        public function actionTest(){
            return $this->render('test');
        }

        //todo test location
        public function actionLocation(){
            $stock = Stock::findOne(1);

            if(!$stock){
                $user = User::find()
                            ->where(['id' => Yii::$app->user->id])
                            ->with('city')
                            ->one();
                $location['city'] = $user->cityName;
                $location['phone'] = $user->phone;
                $location['site'] = $user->site;
            }else{
                $location = $stock->location;
            }
            $model = new LocationForm($location);

            return $this->render('location', ['locationForm' => $model]);
        }

        public function actionEmailError(){
            return $this->render('emailerror');
        }
    }