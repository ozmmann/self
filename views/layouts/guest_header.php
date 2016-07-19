<?php
    use yii\helpers\Url;
?>

<div class="menu-row">
    <a href="#login_popup" value="<?= Url::to(['site/modal-login']) ?>" class="popup-with-form show-login-modal">Войти</a>
    <a href="<?= Yii::$app->urlManager->createUrl(['/site/registration']) ?>" class="btn btn-yellow btn-register">Начать</a>
</div>