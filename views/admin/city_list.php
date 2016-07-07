<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>
<div class="row">
    <div class="col-md-12">
        <?php Pjax::begin() ?>
        <?= Html::beginForm('city-list', 'get', ['class' => 'form-inline']) ?>
        <?= Html::input('text', 'nameSerch', Yii::$app->request->post('nameSerch'), ['class' => 'form-control']) ?>
        <?= Html::submitButton('Найти', ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::endForm() ?>

        <?= Html::a('Добавить город', 'edit-city') ?>
        <table class="table table-striped">
            <tr>
                <th>Город</th>
                <th>Регион(не призрак)</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($citys as $city): ?>
                <tr>
                    <td><?= $city->name ?></td>
                    <td><?= Html::checkbox('', $city->notGhost, ['disabled' => 'disabled']) ?></td>
                    <td><?= Html::a('Изменить', ['admin/edit-city', 'id' => $city->id]) ?></td>
                    <td><?= Html::a('Удалить', ['admin/delete-city', 'id' => $city->id]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= LinkPager::widget(['pagination' => $pagination]); ?>

        <?php Pjax::end() ?>
    </div>
</div>