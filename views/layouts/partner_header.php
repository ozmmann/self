<?php
    use yii\helpers\Html;
?>
<div class="menu-row">
    <div href="#" class="drop-down-menu">
        <?= Yii::$app->user->identity->name ?>
        <div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/partner/index']) ?>">Акции</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/partner/profile']) ?>">Профиль</a>
            <?= Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Выйти', ['class' => 'separated'])
            . Html::endForm()
            ?>
        </div>
    </div>
</div>