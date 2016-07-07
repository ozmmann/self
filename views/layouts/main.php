<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
<?php $this->beginBody() ?>
<?php
//    NavBar::begin([
//        'brandLabel' => 'Pokupon & SuperDeal',
//        'brandUrl' => Yii::$app->user->isGuest
//            ? Yii::$app->homeUrl
//            : '/' . Yii::$app->user->identity->getRole() . "/index",
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    $menu = Yii::$app->user->isGuest ? 'guest.php' : Yii::$app->user->identity->getRole() . '.php';
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => require(__DIR__ . '/' . $menu),
//    ]);
//    NavBar::end();
//    ?>
<div id="header">
    <div class="container">
        <div class="w-100 text-center">
            <a href="<?= Yii::$app->user->isGuest
                ? Yii::$app->homeUrl
                : '/' . Yii::$app->user->identity->getRole() . "/index" ?>" class="logo"><b>P</b>okupon <b>&
                    S</b>uper<b>D</b>eal</a>
        </div>
    </div>
</div>

<?php
if (Yii::$app->controller->id == 'partner'
    || Yii::$app->controller->id == 'site'
):
    ?>
    <?= $content ?>
<?php else: ?>
    <div class="container">
        <div class="wrapper m-auto w-100 w-lg-85">
            <?= $content ?>
        </div>
    </div>
<?php endif; ?>

?>
<? include_once("footer.php"); ?>
<? include_once("feedback.php"); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
