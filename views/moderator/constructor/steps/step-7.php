<?php
    use yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Дата запуска акции</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">
                Выберите желаемую дату старта вашей акции на POKUPON & SUPERDEAL
            </div>
        </div>

        <div class="db calendar">
            <div class="required-field">
                <?= Html::activeInput('date', $stockForm, 'startDate') ?>
                <div class="form-error-msg"></div>
            </div>
        </div>

        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>