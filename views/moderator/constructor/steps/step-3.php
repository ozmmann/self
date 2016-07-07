<? phpuse yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Вкратце об вашей акции</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Напишите заголовок акции на сайте. Например:</div>
            <div class="text mtop-10">Neighborhood Italian eatery with a menu based on four generations of family recipes</div>
        </div>

        <div class="db mtop-30">
            <div class="required-field">
                <?= Html::activeTextarea($stockForm, 'title', [
                    'placeholder' => "Напишите заголовок акции на сайте",
                ]) ?>
                <div class="text">95 символов осталось</div>
                <div class="form-error-msg"></div>
            </div>
        </div>

        <div class="db mtop-60">
            <h4>В кратце опишите свою компанию</h4>
            <div class="required-field">
                <?= Html::activeTextarea($organizerForm, 'name', [
                    'placeholder' => "В кратце опишите свою компанию",
                ]) ?>
                <div class="text">95 символов осталось</div>
                <div class="form-error-msg"></div>
            </div>
        </div>


        <div class="db mtop-40 text-right">
            <button class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
        <div class="db mtop-30">
            <div class="text"><sup>*</sup>Обратите внимание, что наша редакция может изменить или отредактировать ваш текст, перед запуском акции
            </div>
        </div>
    </div>
</div>