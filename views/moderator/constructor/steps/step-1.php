<?php
    use yii\helpers\Html;

    /** @var array $commissionTypes */
?>
<div class="row active">
    <a href="#" class="row-title">Выберете категорию услуги</a>
    <div class="row-content">
        <div class="db">
            <div class="required-field">
                <?= Html::activeDropDownList($stockForm, 'categoryId', $stockCategoryList, [
                    'class'            => 'styled-select',
//                    'prompt'           => '',
                    'data-placeholder' => 'Выберите категорию услуг'
                ]) ?>
                <div class="form-error-msg"></div>
            </div>
        </div>
        <div class="db mtop-30">
            <h3>Напишите заголовок акции на сайте. Например:</h3>
            <div class="text">3 месяца дневного или безлимитного посещения тренажерного зала спортклуба "Grand Sport" </div>
        </div>
        <div class="db">
            <div class="required-field">
                <?= Html::activeTextarea($stockForm, 'title', [
                    'placeholder' => "Напишите заголовок акции на сайте",
                ]) ?>
                <div class="text">95 символов осталось</div>
                <div class="form-error-msg"></div>
            </div>
        </div>
        <div class="db">
            <h3 class="help">Укажите процент скидки</h3>
            <div class="text">Оставайтесь в цветном скидочном диапазоне, для оптимальной эфективности компании</div>
        </div>
        <div class="db precent-slider">
            <div class="current">50</div>
            <div id="precentslider"></div>
            <div class="required-field">
                <?= Html::activeTextInput($stockForm, 'discount', [
                    'class'       => 'current_precent',
                    'id'          => 'discount',
                    'placeholder' => '50%',
                ]) ?><span> %</span>
                <div class="form-error-msg"></div>
            </div>
        </div>

        <span id="loading" class="hidden">Загрузка...</span>
        <div class="db required" id="commissionTypeWrap">
            <h3 class="help">Выберете тип размещения</h3>
            <div class="db mtop-10">
                <div class="required-field">
                    <?= Html::activeDropDownList($stockForm, 'commissionType', \yii\helpers\ArrayHelper::map($commissionTypes,'value','name') ,
                                                 [
                                                     'class'            => ' styled-select',
//                                                     'prompt'           => '',
                                                     'data-placeholder' => 'Выберите тип размещения',
                                                     'data-selected'    => $stockForm->commissionType
                                                 ]) ?>
                    <div class="form-error-msg"></div>
                </div>
            </div>
        </div>
        <div class="db mtop-20 f-0">
            <div class="required-field">
                <h3 class="dib vam w-70">Введите стоимость услуги</h3>
                <?= Html::activeInput('number', $stockForm, 'price', [
                    'class'       => 'dib vam w-30 f-14 text-center',
                    'placeholder' => "××× грн",
                    'min' => 1

                ]) ?>
                <div class="form-error-msg"></div>
            </div>
        </div>
        <div class="db mtop-20 f-0 text-center">
            <div class="dib w-50">
                <h3>Клиент заплатит</h3>
                <div class="db f-12 fw-semi-bold">
                    <span id="coupon_price" class="f-20 price">0</span> грн.
                </div>
            </div>
            <div class="dib w-50">
                <h3 class="help">Вы получите</h3>
                <div class="db f-12 fw-semi-bold">
                    <span id="webmaster_reward" class="f-20">0</span> грн.
                </div>
            </div>
        </div>
        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>