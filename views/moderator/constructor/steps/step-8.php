<? phpuse yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Дата окончания акции</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Для того чтобы обеспечить время для рассмотрения вашей сделки Покупон&Супердилом, выберите одну из ближайших
                доступных дат.
            </div>
        </div>

        <div class="db calendar">
            <div class="required-field">
                <?= Html::activeInput('date', $stockForm, 'endDate') ?>
                <div class="form-error-msg"></div>
            </div>
        </div>

        <div class="db mtop-40 text-right">
            <button type="submit" class="btn btn-yellow btn-next-step">Закончить</button>
        </div>
    </div>
</div>