<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html" charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="<?= Yii::$app->controller->id == 'site' ? 'site ' . Yii::$app->controller->action->id : '' ?>">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-K2X8CJ"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K2X8CJ');</script>
<!-- End Google Tag Manager -->
<?php $this->beginBody() ?>

<?php include_once("header.php"); ?>

<?= $content ?>

<?php if (Yii::$app->user->isGuest): ?>
    <?php $model = new \app\models\forms\LoginForm(); ?>
    <div class="mfp-hide popup-data" id="login_popup">
        <div class="popup-data">
            <div class="content" id="modalContent">
                <div class="f-30 fw-semi-bold">Вход для партнеров</div>
                <?php $form = ActiveForm::begin([
                    'id' => 'login_form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                    'action' => '/site/modal-login'
                ]); ?>

                <div class="row mtop-20">
                    <?= $form->field($model, 'login')
                        ->textInput([
                            'autofocus' => true,
                            'id' => 'login',
                            'placeholder' => 'email@localhost.com'
                        ])
                        ->label('Email:') ?>
                </div>
                <div class="row mtop-20 pos-rel">
                    <?= $form->field($model, 'password')
                        ->passwordInput([
                            'id' => 'password',
                            'placeholder' => "•••••••••"
                        ])
                        ->label('Пароль:<a href="#" class="show-password sm-hide"></a>') ?>

                </div>
                <div class="db checkbox-list mtop-20">
                    <?= Html::activeCheckbox(
                        $model,
                        'rememberMe',
                        [
                            'label' => '<i></i><span>Запомните меня</span>',
                            'labelOptions' => ['class' => 'vam w-68']
                        ]);
                    ?><i></i>
                    <?= Html::a('Забыл пароль', ['site/restore-password-request'], ['class' => 'dib vam w-30 text-right']) ?>
                </div>

                <div class="mtop-20 cta">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-blue', 'name' => 'login-button']) ?>
                    <?= Html::a('Регистрация', ['site/registration'], ['class' => 'pull-right mtop-15']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once("footer.php"); ?>
<?php include_once("feedback.php"); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
