<?php
use yii\helpers\Html;
?>
<div class="row">
    <a href="#" class="row-title">Вкратце о вашей Компании</a>
    <div class="row-content">
        <div class="db mtop-30">
            <h3>Кратко и емко опишите вашу компанию.</h3>
            <div class="required-field">
                <?= Html::activeTextarea($organizerForm, 'name', [
                    'placeholder' => "Например: Салон красоты N находится в самом центре столицы. Все мастера салона имеют сертификаты, подтверждающие их высокий уровень профессионализма.",
                    'maxLength' => 255
                ]) ?>
                <div class="text">95 символов осталось</div>
                <div class="form-error-msg f-14"></div>
            </div>
        </div>


        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
        <div class="db mtop-30">
            <div class="text"><sup>*</sup>Обратите внимание, что наша редакция может изменить ваш текст перед запуском акции.</div>
        </div>
    </div>
</div>