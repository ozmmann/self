<?php

namespace app\controllers;

use app\models\City;
use app\models\Confirm;
use app\models\forms\RegistrationForm;
use app\models\forms\RestorePasswordForm;
use app\models\Restore;
use app\models\Stocktype;
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
        throw new yii\base\UserException('Ошибка подтверждения! Проверте ссылку или обратитесь к администратору');
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
//                return $this->render('errorPasswordRestore');
            }
        }

        return $this->render('restorePassword',
                             ['model'=> $model]);
    }

    public function actionRestorePassword($token){
        if(Restore::restorePassword($token)){
            return $this->render('successPasswordRestore');
        }

        throw new yii\base\UserException('Ошибка восстановления! Проверте ссылку или обратитесь к администратору');
//        return $this->render('errorPasswordRestore');
    }
}
