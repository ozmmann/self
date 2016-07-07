<?php

use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Список городов', ['admin/city-list']); ?>
        <br>
        <?= Html::a('Список коммисий', ['admin/commission-list']) ?>
        <br>
        <?= Html::a('Список категорий', ['admin/stock-category-list']) ?>
    </div>
</div>