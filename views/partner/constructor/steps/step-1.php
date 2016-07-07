<?php
    use yii\helpers\Html;
?>
<div class="row active">
    <a href="#" class="row-title">Выберете категорию услуги</a>
    <div class="row-content">
        <div class="db">
<!--            --><?//= $form->field($stockForm, 'categoryId')
//                ->label('Категория')
//                ->dropDownList($stockCategoryList, [
//                    'prompt'           => '',
//                    'data-placeholder' => 'Выберите категорию услуг',
//                    'class'            => 'chosen styled-select'
//                ]) ?>
            <div class="required-field">
                <?= Html::activeDropDownList(
                    $stockForm,
                    'categoryId',
                    $stockCategoryList,
                    [
                        'class' => 'chosen styled-select',
                        'prompt' => '',
                        'data-placeholder' => 'Выберите категорию услуг'
                    ]
                ) ?>
                    <div class="form-error-msg f-14"></div>
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
                <div class="form-error-msg f-14"></div>
            </div>
        </div>

        <span id="loading" class="hidden">Загрузка...</span>
        <div class="db required hidden" id="commissionTypeWrap">
            <h3>Выберете тип размещения</h3>
            <div class="db mtop-10">
                <div class="required-field">
                    <?= Html::activeDropDownList(
                        $stockForm,
                        'commissionType',
                        [],
                        [
                            'class' => 'chosen styled-select',
                            'prompt' => '',
                            'data-placeholder' => 'Выберите тип размещения'
                        ]
                    ) ?>
                    <div class="form-error-msg f-14"></div>
                </div>
            </div>
        </div>
        <div class="db mtop-20 f-0">
            <div class="required-field">
                <h3 class="dib vam w-70">Введите стоимость услуги</h3>
                <?= Html::activeTextInput($stockForm, 'price', [
                    'class'       => 'dib vam w-30 f-14 text-center',
                    'placeholder' => "××× грн",
                ]) ?>
                <div class="form-error-msg f-14"></div>
            </div>
        </div>
        <div class="db mtop-20 f-0 text-center">
            <div class="dib w-50">
                <h3>Клиент заплатит</h3>
                <div class="db f-12 fw-semi-bold">
                    <span id="coupon_price" class="f-20 price">280</span> грн.
                </div>
            </div>
            <div class="dib w-50">
                <h3 class="help">Вы получите</h3>
                <div class="db f-12 fw-semi-bold">
                    <span id="webmaster_reward" class="f-20">280</span> грн.
                </div>
            </div>
        </div>
        <div class="db mtop-40 text-right">
            <button class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>