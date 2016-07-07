<? phpuse yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">На что действует акция</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Напишите, что получит пользователь воспользовавшись вашей акцией</div>
        </div>

        <div class="coupon-row">
            <div class="db mtop-20 f-0">
                <h3 class="help dib w-70">Стоимость услуги</h3>
                <div class="dib w-30 f-14 fw-light"><span class="price">20</span> <span class="f-12 c-gray">грн</span></div>
            </div>

            <div class="db f-0">
                <h3 class="help dib w-70">Процент скидки</h3>
                <div class="dib w-30 f-14 fw-light"><span class="discount">90</span> <span class="f-12 c-gray">%</span></div>
            </div>


            <div class="db mtop-10">
                <div class="required-field">
                    <?= Html::activeTextarea($stockForm, 'description', [
                        'placeholder' => 'Описание акции',
                    ]) ?>

                    <?php //todo js for symbols count ?>
                    <div class="text">95 символов осталось</div>
                    <div class="form-error-msg"></div>
                </div>
            </div>
        </div>

        <div class="db mtop-40 text-right">
            <button class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
        <div class="db mtop-30">
            <div class="text"><sup>*</sup>Обратите внимание, что наша редакция может изменить или отредактировать ваш
                текст, перед запуском акции
            </div>
        </div>
    </div>
</div>