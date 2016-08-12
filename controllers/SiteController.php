<?php

namespace app\controllers;

use app\models\City;
use app\models\Confirm;
use app\models\forms\NewPasswordForm;
use app\models\forms\RegistrationForm;
use app\models\forms\RestorePasswordForm;
use app\models\Restore;
use app\models\Stocktype;
use app\models\User;
use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\forms\LoginForm;

class SiteController extends Controller{
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'registration', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'pages' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionModalLogin() {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $controllerUri = '/'.Yii::$app->user->identity->getRole();
            return $this->redirect($controllerUri);
        }else if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogin(){

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $controllerUri = '/'.Yii::$app->user->identity->getRole();
            return $this->redirect($controllerUri);
        }
        return $this->render('login', [
            'model' => $model,
        ]);

    }

    public function actionConfirm($confirm){
        if(Confirm::confirmEmail($confirm)){
            return $this->render('successConfirm');
        }

        $controllerUri = Yii::$app->user->isGuest ? Yii::$app->urlManager->createUrl(['site/login']) : '/'.Yii::$app->user->identity->getRole();
        return $this->redirect($controllerUri);
//        throw new yii\base\UserException('Ошибка подтверждения! Проверте ссылку или обратитесь к администратору');
//        return $this->render('errorConfirm');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistration(){

        $model = new RegistrationForm();
        $stockTypeList = Stocktype::find()->all();
        $cityList = City::find()->all();

        if($model->load(Yii::$app->request->post()) && $model->registration()){
            return $this->render('successReg');
        }

        return $this->render('registration', ['model'=> $model, 'stockTypeList' => $stockTypeList, 'cityList' => $cityList]);
    }

    public function actionRestorePasswordRequest(){

        $model = new RestorePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {

                return $this->render('successPasswordRestore');
            } else {

                throw new yii\base\UserException('Ошибка восстановления! Обратитесь к администратору');
            }
        }

        return $this->render('restorePassword',
                             ['model'=> $model]);
    }

    public function actionRestorePassword($token){
        $model = new NewPasswordForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $now = time();
            $restoreData = Restore::findOne(['link' => $token]);

            if (!is_null($restoreData) and ($restoreData->sendDate + 3600 * 24) >= $now) {
                $user = User::findOne(['id' => $restoreData->userId]);
                $user->password = Yii::$app->getSecurity()
                    ->generatePasswordHash($model->password);
                if($user->save(false)){
                    $restoreData->delete();
                    return $this->render('successPasswordRestoreRequest');
                } else {
                    throw new yii\base\UserException('Ошибка восстановления! Проверте ссылку или обратитесь к администратору');
                }
            }
        }

        return $this->render('newpasswordform', ['model' => $model]);
    }
}
