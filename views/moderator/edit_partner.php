<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($partnerForm, 'name')
            ->textInput() ?>
        <?= $form->field($partnerForm, 'phone')
            ->input('tel') ?>
        <?= $form->field($partnerForm, 'secondPhone')
            ->input('tel') ?>
        <?= $form->field($partnerForm, 'status')
            ->dropDownList([
                'ACTIVE' => 'Активный',
                'INACTIVE' => 'На модерации',
                'BLOCKED' => 'Заблокирован'
            ], [$partnerForm['status'] => ['seletion' => 'selected'], 'class' => 'default']) ?>
        <?= $form->field($partnerForm, 'cityId')
            ->label('Город')
            ->dropDownList(ArrayHelper::map($cityList, 'id', 'name'),
                [
                    'class' => 'chosen styled-select',
                    'prompt' => '',
                    'data-placeholder' => 'Выберите город...'
                ]) ?>
        <?= $form->field($partnerForm, 'stockTypeId')
            ->label('Категория услуг')
            ->dropDownList(ArrayHelper::map($stockTypeList, 'id', 'name'), [
                'prompt' => '',
                'data-placeholder' => 'Выберите категорию услуг...',
            ]) ?>
        <?= $form->field($partnerForm, 'site')
            ->input('url') ?>
        <?= $form->field($partnerForm, 'inn')->label('ИНН партнера')
            ->input('text') ?>

        <div class="dib">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-yellow btn-next-step']) ?>
                <?= Html::a(
                    'Отмена',
                    empty(Yii::$app->request->referrer) ? ['/moderator/partner-list'] : Yii::$app->request->referrer,
                    ['class' => 'btn btn-blue btn-step']
                ); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
