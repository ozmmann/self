<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($stockCategory, 'name')->label('Имя категории') ?>
        <?= $form->field($stockCategory, 'parentId')->label('Родительская категория')
                 ->dropDownList($categoryList, ['prompt' => '', 'data-placeholder' => 'Выберите родительскую категорию']) ?>
        <?= Html::submitButton('Сохранить') ?>
        <?= Html::a('Отмена', empty(Yii::$app->request->referrer) ? ['/moderator/partner-list'] : Yii::$app->request->referrer); ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
