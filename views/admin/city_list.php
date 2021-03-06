<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
$this->title = 'Список городов';
?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php Pjax::begin() ?>
        <?= Html::beginForm('city-list', 'get', ['class' => 'form-inline db']) ?>
        <?= Html::input('text', 'nameSerch', Yii::$app->request->post('nameSerch'), ['class' => 'form-control']) ?>
        <?= Html::submitButton('Найти', ['class' => 'btn btn-yellow btn-next-step']) ?>
        <?= Html::endForm() ?>

        <?= Html::a('Добавить город', 'edit-city', ['class' => 'btn btn-blue btn-add mtop-10', 'style' => 'float: none;']) ?>
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