<?php
use yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Добавьте условия акции</a>
    <div class="row-content">
        <div class="db">
            <h3>Обязательные поля для заполнения
                <div class="helper">
                    <div class="helper-content-wrapper">
                        <div class="helper-content">
                            Отметьте обязательные условия предоставления скидки, или добавьте свое
                        </div>
                    </div>
                </div>
            </h3>
        </div>

        <div class="db checkbox-list">
            <?= Html::activeCheckbox($conditionForm, 'isCount', ['label' => '<i></i><span>1 купон распространяется на N человек</span>']) ?>
            <div class="hidden" id="countPersonWrap">
                <div class="row">
                    <label class="control-label col-lg-5">Количество человек</label>
                    <?= Html::activeInput('number', $conditionForm, 'countPerson', ['class' => 'form-control', 'value' => 1, 'min' => 1]) ?>
                </div>
            </div>
            <?= Html::activeCheckbox($conditionForm, 'preEntry', ['label' => '<i></i><span>Обязательна предварительная запись</span>']) ?>

            <?= Html::activeCheckbox($conditionForm, 'preCall', ['label' => '<i></i><span>Перед визитом свяжитесь с администрацией</span>']) ?>

            <?= Html::activeCheckbox($conditionForm, 'discountSum', ['label' => '<i></i><span>Скидка по купону не суммируется с другими предложениями заведения</span>']) ?>

            <?= Html::activeCheckbox($conditionForm, 'dispatcherCall', ['label' => '<i></i><span>Для получения скидки необходимо назвать код купона</span>']) ?>

            <?= Html::activeCheckbox($conditionForm, 'showCoupon', ['label' => '<i></i><span>Предъявите сертификат в электронном или распечатанном виде</span>']) ?>

            <div class="db mtop-10">
                <h3>Свое условие</h3>
                <?= Html::activeTextarea($conditionForm, 'own', [
                    'placeholder' => 'Свое условие',
                    'maxLength' => 255
                ]) ?>
                <div class="text">255 символов осталось</div>
            </div>
        </div>


        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>