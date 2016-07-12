<?php

    use yii\widgets\DetailView;

$title = isset($title) ? $title : 'Профиль';
?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <h3><?= $title ?></h3>

        <?= DetailView::widget([
                                   'model'      => $moderator,
                                   'attributes' => [
                                       'name:text:Имя',
                                       'phone:text:Телефон',
                                       'email',
                                       [
                                           'attribute' => 'cityId',
                                           'label'     => 'Город',
                                           'value'     => $moderator->getCityName(),
                                       ],
                                       [
                                           'attribute' => 'stockTypeId',
                                           'label'     => 'Тип акций',
                                           'value'     => $moderator->getStockTypeName(),
                                       ],
                                   ],
                               ]); ?>
    </div>
</div>