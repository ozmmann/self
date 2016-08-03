<?php

use yii\helpers\Html;
$this->title = 'Dashboard';
?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?= Html::a('Список городов', ['admin/city-list'], ['class' => 'dib mtop-20 f-16']); ?>
        <br>
        <?= Html::a('Список коммисий', ['admin/commission-list'], ['class' => 'dib mtop-20 f-16']) ?>
        <br>
        <?= Html::a('Список категорий', ['admin/stock-category-list'], ['class' => 'dib mtop-20 f-16']) ?>
    </div>
</div>