<?php
use yii\helpers\Url;

?>
<div id="footer">
    <div class="container text-center">
        <div class="dib w-85 f-0 text-center">
            <div class="dib vat w-33 w-md-33 md-text-center w-sm-100 sm-text-center f-14 text-center">
                <div class="dib text-left">
                    <div class="title fw-semi-bold f-30">О нас</div>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/pages?view=terms']) ?>" target="_blank">Пользовательское
                        соглашение</a>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/pages?view=privacy_policy']) ?>"
                       target="_blank">Политика конфиденциальности</a>
                </div>
            </div>
            <div class="dib vat w-33 w-md-33 md-text-center w-sm-100 sm-text-center mtop-sm-20 f-14 text-center">
                <div class="dib text-left">
                    <div class="title fw-semi-bold f-30">Партнёрам</div>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/pages?view=privacy_policy']) ?>"
                       target="_blank">Вопросы и ответы</a>
                </div>
            </div>
            <div class="dib vat w-33 w-md-33 md-text-center w-sm-100 sm-text-center mtop-sm-20 f-14 text-center">
                <div class="dib text-left">
                    <div class="title fw-semi-bold f-30">Контакты</div>
                    <a href="tel:+380445858086">Тел.: +38 (044) 585-80-86</a>
                    <a href="mailto:partners@pokupon.ua">E-mail: <?= Yii::$app->params['adminEmail'] ?></a>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="#login_popup" value="<?= Url::to(['/site/modal-login']) ?>"
                           class="popup-with-form btn btn-white-blue-border btn-add">Добавить акцию</a>
                    <?php else: ?>
                        <a href="<?= Yii::$app->urlManager->createUrl('/partner/create-stock') ?>"
                           class="btn btn-white-blue-border btn-add">Добавить акцию</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>