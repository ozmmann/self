<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($stockCategory, 'name')->label('Имя категории') ?>
        <?= $form->field($stockCategory, 'parentId')->label('Родительская категория')
                 ->dropDownList($categoryList, ['prompt' => '', 'data-placeholder' => 'Выберите родительскую категорию']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-yellow btn-next-step']) ?>
        <?= Html::a(
            'Отмена',
            empty(Yii::$app->request->referrer) ? ['/moderator/partner-list'] : Yii::$app->request->referrer,
            ['class' => 'btn btn-blue btn-step']
        ); ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
