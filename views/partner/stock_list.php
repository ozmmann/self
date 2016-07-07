<?php

use yii\widgets\LinkPager;

?>
<div id="cabinet">
    <div class="container">
        <div class="w-100 w-lg-85 m-auto white-wrap">
            <div class="w-100 f-34 fw-bold text-center">
                Личный кабинет
            </div>
            <div class="mtop-40 data-table">

                <div class="w-100 controlls">
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/index') ?>" class="btn btn-white-gray-border active">Акции</a>
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/profile') ?>" class="btn btn-white-gray-border">Личная информация</a>
                    <a href="#" class="btn btn-white-gray-border" disabled="true" style="opacity: 0.6; pointer-events: none;">История оплат</a>
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/create-stock') ?>" class="btn btn-blue">Добавить
                        акцию</a>
                </div>

                <div class="header text-center f-0">
                    <div class="dib w-20">
                        Акция
                    </div>
                    <div class="dib w-12">
                        Статус
                    </div>
                    <div class="dib w-12">
                        Скидка
                    </div>
                    <div class="dib w-12">
                        Стоимость
                    </div>
                    <div class="dib w-12">
                        Тип акции
                    </div>
                    <div class="dib w-12">
                        Комиссия
                    </div>
                    <div class="dib w-20">
                        Действие
                    </div>
                </div>
                <?php if ($stocks): ?>
                    <?php foreach ($stocks as $stock): ?>

                        <div class="data-row f-0">
                            <div class="dib w-20">
                                <img src="<?= $stock->picture == "error" ? '/img/noimage.jpg' : $stock->picture ?>"
                                     alt="<?= $stock['title'] ?>" class="img-response">
                            </div>
                            <div class="dib w-12 status <?= $stock->status ?>">
                                <?= Yii::$app->params['stockStatus'][$stock->status] ?>
                            </div>
                            <div class="dib w-12">
                                <?= $stock->discount ?>%
                            </div>
                            <div class="dib w-12">
                                <?= $stock->price ?> грн.
                            </div>
                            <div class="dib w-12 type">
                                <?= Yii::$app->params['commissionType'][$stock->commissionType] ?>
                            </div>
                            <div class="dib w-12">
                                <?php
                                $label = "";
                                switch ($stock->commissionType) {
                                    case "FIXED":
                                        $label = 'грн/мес';
                                        break;
                                    case "PERCENT":
                                        $label = "%";
                                        break;
                                    case "FREE":
                                        $label = false;
                                        break;
                                }
                                ?>
                                <?= $label ? $stock->commissionValue : "" ?><?= $label ? $label : 'б/п размещение' ?>
                            </div>
                            <div class="dib w-20">
                                <a href="#" class="btn edit" disabled="true"></a>
                                <a href="#" class="btn refresh" disabled="true"></a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['partner/stock', 'id' => $stock->id]) ?>" class="btn open"></a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="data-row">
                        <h2>Нет активных акций</h2>
                    </div>
                <?php endif; ?>


            </div>
            <div class="mtop-40">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'prevPageLabel' => '&larr;',
                    'nextPageLabel' => '&rarr;',
                    'disabledPageCssClass' => 'btn',
                    'linkOptions' => [
                        'class' => 'btn'
                    ]
                ]); ?>

            </div>
            <div class="pagination-description hidden">
                2 - 37 <br>
                Всего 48 (2 активны)
            </div>
        </div>
    </div>
</div>