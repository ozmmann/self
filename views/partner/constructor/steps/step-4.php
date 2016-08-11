<?php
    use yii\helpers\Html;
?>
<div class="row">
    <a href="#" class="row-title">На что действует акция</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Напишите, что получит пользователь воспользовавшись вашей акцией</div>
        </div>

        <div class="coupon-row">
            <div class="db mtop-20 f-0">
                <h3 class="dib w-70">Стоимость услуги
                    <div class="helper">
                        <div class="helper-content-wrapper">
                            <div class="helper-content">
                                Полная стоимость предоставляемой вами услуги без учета скидки
                            </div>
                        </div>
                    </div>
                </h3>
                <div class="dib w-30 f-14 fw-light"><span class="full-price">20</span> <span class="f-12 c-gray">грн</span></div>
            </div>

            <div class="db f-0">
                <h3 class="dib w-70">Процент скидки
                    <div class="helper">
                        <div class="helper-content-wrapper">
                            <div class="helper-content">
                                Скидка, которую вы даете нашему пользователю. От процента скидки зависят некоторые условия размещения акции. Чем больше скидка - тем выгоднее условия.
                            </div>
                        </div>
                    </div>
                </h3>
                <div class="dib w-30 f-14 fw-light"><span class="discount">90</span> <span class="f-12 c-gray">%</span></div>
            </div>


            <div class="db mtop-10">
                <div class="required-field">
                    <?= Html::activeTextarea($stockForm, 'description', [
                        'placeholder' => 'Опишите на что распространяется скидка',
                        'maxLength' => 1000,
                        'class' => 'w-90'
                    ]) ?>
                    <div class="helper mtop-10 pull-right">
                        <div class="helper-content-wrapper">
                            <div class="helper-content">
                                Опишите на что распространяется скидка. Например: "Рыбалка для одного человека за 65 грн. вместо 100 грн."
                            </div>
                        </div>
                    </div>
                    <div class="text">95 символов осталось</div>
                    <div class="form-error-msg f-14"></div>
                </div>
            </div>
        </div>

        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
        <div class="db mtop-30">
            <div class="text"><sup>*</sup>Обратите внимание, что наша редакция может изменить или отредактировать ваш
                текст, перед запуском акции
            </div>
        </div>
    </div>
</div>