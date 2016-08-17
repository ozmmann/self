<?php
$this->title = 'Подтверждение email';
?>
<div id="success_page">
    <div class="container">
        <div id="info_page_wrapper" class="w-85 m-auto text-center">
            <img src="/img/success-image.png" class="img-response mtop-40 mtop-lg-80">
            <div class="f-34 lh-1-4 fw-semi-bold mtop-40">Ваш email был успешно подтвержден!<br>
                <a href="<?= Yii::$app->urlManager->createUrl('partner/create-stock') ?>" class="btn btn-blue btn-add mtop-20" style="float: none">Добавить
                    акцию</a>
            </div>
        </div>
    </div>
</div>