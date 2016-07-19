<?php
    use yii\helpers\Html;
?>
<div class="menu-row">
    <div href="#" class="drop-down-menu">
        <?= Yii::$app->user->identity->name ?>
        <div>
            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/city-list']) ?>">Города</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/commission-list']) ?>">Комиссии</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/stock-category-list']) ?>">Категории</a>
            <?= Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Выйти', ['class' => 'separated'])
            . Html::endForm()
            ?>
        </div>
    </div>
</div>