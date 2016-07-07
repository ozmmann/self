<div id="cabinet">
    <div class="container">
        <div class="w-100 w-lg-85 m-auto white-wrap">
            <div class="w-100 f-34 fw-bold text-center">
                Личный кабинет
            </div>
            <div class="mtop-40 data-table">

                <div class="w-100 controlls">
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/index') ?>"
                       class="btn btn-white-gray-border">Акции</a>
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/profile') ?>"
                       class="btn btn-white-gray-border active">Личная информация</a>
                    <a href="#" class="btn btn-white-gray-border" disabled="true"
                       style="opacity: 0.6; pointer-events: none;">История оплат</a>
                    <a href="<?= Yii::$app->urlManager->createUrl('partner/create-stock') ?>" class="btn btn-blue">Добавить
                        акцию</a>
                </div>

                <div class="header text-center f-0">
                    <div class="dib w-16">
                        Имя
                    </div>
                    <div class="dib w-16 ">
                        Телефоны
                    </div>
                    <div class="dib w-20 ">
                        Email
                    </div>
                    <div class="dib w-16 ">
                        Статус
                    </div>
                    <div class="dib w-16 ">
                        Город
                    </div>
                    <div class="dib w-16 ">
                        Категория услуг
                    </div>
                </div>
                <div class="data-row f-0">
                    <div class="dib w-16 ">
                        <?= $partner->name ?>
                    </div>
                    <div class="dib w-16 ">
                        <?= $partner->phone ?>
                    </div>
                    <div class="dib w-20 ">
                        <?= $partner->email ?>
                    </div>
                    <div class="dib w-16  status <?= $partner->status ?>">
                        <?= Yii::$app->params['userStatus'][$partner->status] ?>
                    </div>
                    <div class="dib w-16 ">
                        <?= $partner->getCityName() ?>
                    </div>
                    <div class="dib w-16 ">
                        <?= $partner->getStockTypeName() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>