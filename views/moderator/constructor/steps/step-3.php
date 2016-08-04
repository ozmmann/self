<?php
    use yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Вкратце о вашей Компании</a>
    <div class="row-content">
        <div class="db mtop-30">
            <h3>В кратце опишите компанию предоставляющую услугу. Например:</h3>
            <div class="text">Хотите совместить отдых с семьей в живописном месте и любимое занятие? Тогда обратите внимание на наш комплекс в живописном лесу. </div>
            <div class="required-field">
                <?= Html::activeTextarea($organizerForm, 'name', [
                    'placeholder' => "В кратце опишите свою компанию",
                ]) ?>
                <div class="text">95 символов осталось</div>
                <div class="form-error-msg"></div>
            </div>
        </div>


        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
        <div class="db mtop-30">
            <div class="text"><sup>*</sup>Обратите внимание, что наша редакция может изменить или отредактировать ваш текст, перед запуском акции
            </div>
        </div>
    </div>
</div>