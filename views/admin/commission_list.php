<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'Список комиссий';

    /** @var \app\models\Commission $commissions */
?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php Pjax::begin() ?>
        <?= Html::beginForm('commission-list', 'get', ['class' => 'form-inline dib']) ?>
        <?= Html::input('text', 'nameSerch', Yii::$app->request->post('nameSerch'), ['class' => 'form-control']) ?>
        <?= Html::submitButton('Найти', ['class' => 'btn btn-yellow btn-next-step']) ?>
        <?= Html::endForm() ?>

        <?= Html::a('Добавить коммисию', ['admin/edit-commission'], ['class' => 'btn btn-blue btn-add mtop-10']) ?>
        <?php
            if(count($commissions)): ?>
            <table class="table table-striped">
                <tr>
                    <th>Категория</th>
                    <th>Регион</th>
                    <th>Процент</th>
                    <th>Фиксируемая стоимость</th>
                    <th>Бесплатное размещение</th>
                    <th></th>
                </tr>
                <?php
                    foreach($commissions as $commission): ?>
                    <tr>
                        <td><?= $commission->categoryName ?></td>
                        <td><?= $commission->cityType ?></td>
                        <td><?= $commission->percent ?></td>
                        <td><?= $commission->fixed ?></td>
                        <td><?= $commission->free ?></td>
                        <td>
                            <?= Html::a('Изменить', ['admin/edit-commission', 'id' => $commission->id, 'catId' => $commission->stockCategoryId]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <?php Pjax::end() ?>
    </div>
</div>