<?php

    use yii\widgets\DetailView;

    echo "test";

?>
<div class="row">
    <div class="col-md-12">
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