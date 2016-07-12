<?php

use yii\helpers\Html;

?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?= Html::a('Список городов', ['admin/city-list']); ?>
        <br>
        <?= Html::a('Список коммисий', ['admin/commission-list']) ?>
        <br>
        <?= Html::a('Список категорий', ['admin/stock-category-list']) ?>
    </div>
</div>