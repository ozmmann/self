<?php
$this->title = 'Вы не подтвердили ваш email';
?>
<div id="success_page">
    <div class="container">
        <div id="info_page_wrapper" class="w-85 m-auto text-center">
            <img src="/img/success-image.png" class="img-response mtop-40 mtop-lg-80">
            <div class="f-34 lh-1-4 fw-semi-bold mtop-40">Вы не подтвердили ваш email<br>
                Мы отправили письмо для подтверждения регистрации.
            </div>
            <div class="f-14 c-gray lh-1-4 fw-light mtop-40">
                <?php
                if (isset($alreadySend) && $alreadySend):
                    date_default_timezone_set('Europe/Kiev');
                    ?>
                    Письмо было отправлено в <?= date('H:i', $confirmDate) ?>,
                    повторное письмо можно будет отправить в <?= date('H:i', $confirmDate + 3600) ?>

                <?php else: ?>
                    Подтвердите регистрацию из письма, чтобы получить доступ к созданию акций.<br>
                    <a href="<?= Yii::$app->urlManager->createUrl(['partner/resend-confirm']) ?>">Не пришло письмо?</a><br>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>