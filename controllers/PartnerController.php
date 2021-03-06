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
    use yii\base\Exception;
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
                          ->orderBy('id DESC');

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
            if(!$this->isConfirmed()){
                return $this->render('index_not_confirmed');
            }

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
                        try {
                            if (is_dir(Yii::$app->basePath . $categoryStorage)) {
                                $defaultCategory = new \DirectoryIterator(Yii::$app->basePath . $categoryStorage);
                                foreach ($defaultCategory as $cover) {
                                    if ($cover->isDot() or $cover->isDir()) {
                                        continue;
                                    }

                                    if(strpos($cover->getFilename(), 'thumb_') !== false){
                                        continue;
                                    }

                                    $covers[] = $categoryStorage . $cover->getFilename();
                                }
                            }
                        } catch (Exception $e) {
                            Yii::error('Getting category folder images: ' . $e);
                        }

                        $userStorage = '/web/storage/users_uploads/'.Yii::$app->user->getId().'/';
                        try {
                            if (is_dir(Yii::$app->basePath . $userStorage)) {
                                $userCovers = new \DirectoryIterator(Yii::$app->basePath . $userStorage);
                                foreach ($userCovers as $cover) {
                                    if ($cover->isDot() or $cover->isDir()) {
                                        continue;
                                    }

                                    if(strpos($cover->getFilename(), 'thumb_') !== false){
                                        continue;
                                    }

                                    $covers[] = $userStorage . $cover->getFilename();
                                }
                            }
                        } catch (Exception $e) {
                            Yii::error('Getting category folder images: ' . $e);
                        }
                        Yii::$app->response->format = 'json';

                        return $covers;
                        break;
                }

                if(Yii::$app->request->isPost && Yii::$app->request->post('upload') == 1){
                    $model = new CoverUploadForm();

                    $model->cover = UploadedFile::getInstance($model, 'cover');
                    if($model->upload()){
                        return $model->coverName;
                    }

                    return false;
                }

                if(Yii::$app->request->isPost && Yii::$app->request->post('remove') == 1){
                    $path = Yii::$app->request->post('path');
                    $dir = Yii::$app->basePath . '/web';
                    if(file_exists($dir . $path) && unlink($dir . $path)){

                        return true;
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
            $title = "Подтвердите Ваш email, <br>нажав на кнопку";

            $body ="Перейдите на следующий шаг, чтобы подтвердить Ваш email.";

            Email::sendEmail(
                'mail-template-html',
                'Добро пожаловать на Pokupon.ua & SuperDeal.ua',
                $title,
                $link,
                $body,
                [Yii::$app->params['adminEmail'] => 'Pokupon.ua & SuperDeal.ua'],
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

        public function actionEmailError(){
            return $this->render('emailerror');
        }
    }