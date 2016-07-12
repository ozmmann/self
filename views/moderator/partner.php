<?php


?>
<div id="cabinet">
    <div class="container">
        <div class="w-100 w-lg-85 m-auto white-wrap">
            <div class="w-100 f-34 fw-bold text-center">
                <?= $partner->name ?>
            </div>
            <div class="mtop-40 data-table">

                <div class="header text-center f-0">
                    <div class="dib w-16">
                        Телефоны
                    </div>
                    <div class="dib w-20">
                        Email
                    </div>
                    <div class="dib w-16">
                        Статус
                    </div>
                    <div class="dib w-16">
                        Город
                    </div>
                    <div class="dib w-16">
                        Категория услуг
                    </div>
                    <div class="dib w-16">
                        Действие
                    </div>
                </div>
                <div class="data-row f-0">
                    <div class="dib w-16">
                        <?= $partner->phone ?>
                    </div>
                    <div class="dib w-20">
                        <?= $partner->email ?>
                    </div>
                    <div class="dib w-16 status <?= $partner->status ?>">
                        <?= Yii::$app->params['userStatus'][$partner->status] ?>
                    </div>
                    <div class="dib w-16">
                        <?= $partner->getCityName() ?>
                    </div>
                    <div class="dib w-16 type">
                        <?= $partner->getStockTypeName() ?>
                    </div>
                    <div class="dib w-16">
                        <a href="<?= Yii::$app->urlManager->createUrl(['moderator/edit-partner', 'id' => $partner->id]) ?>" class="btn edit"></a>
                        <a href="#" class="btn refresh" disabled="true"></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>