<?php
$this->title = 'Успешная регистрация';
?>
<div id="success_page">
    <div class="container">
        <div id="info_page_wrapper" class="w-85 m-auto text-center">
            <img src="/img/success-image.png" class="img-response mtop-40 mtop-lg-80">
            <div class="f-34 lh-1-4 fw-semi-bold mtop-40">Спасибо!<br>
                Мы отправили письмо для подтверждения регистрации.
            </div>
            <div class="f-14 c-gray lh-1-4 fw-light mtop-40">
                Подтвердите регистрацию из письма, чтобы получить доступ к созданию акций.<br>
                <a href="<?= Yii::$app->urlManager->createUrl(['partner/resend-confirm']) ?>">Не пришло письмо?</a><br>
            </div>
        </div>
    </div>
</div>