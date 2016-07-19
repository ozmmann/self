<?php
    use yii\helpers\Html;
?>
<div class="menu-row">
    <div href="#" class="drop-down-menu">
        <?= Yii::$app->user->identity->name ?>
        <div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/moderator/']) ?>">Dashboard</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/moderator/stock-list']) ?>">Все Акции</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/moderator/partner-list']) ?>">Все Пользователи</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/moderator/profile']) ?>">Профиль</a>
            <?= Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Выйти', ['class' => 'separated'])
            . Html::endForm()
            ?>
        </div>
    </div>
</div>