<?php
use yii\helpers\Html;
?>
<div class="row">
    <a href="#" class="row-title">Дата окончания акции</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">
                Укажите желаемую дату окончания акции
            </div>
        </div>
        
        <div class="db calendar">
            <div class="required-field">
                <?= Html::activeInput('date', $stockForm, 'endDate') ?>
                <div class="form-error-msg f-14"></div>
            </div>
        </div>

        <div class="db mtop-40 text-right">
            <?= Html::submitButton('Закончить', ['class'=>'btn btn-yellow btn-next-step']) ?>
        </div>
    </div>
</div>