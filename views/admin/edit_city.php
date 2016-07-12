<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($cityForm, 'name')->label('Город') ?>
        <?= $form->field($cityForm, 'notGhost')
                 ->checkbox(['label' => '<span>Регион(не призрак)<span>', 'labelOptions' => ['class' => 'checkbox-inline']]) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-yellow btn-next-step']) ?>
        <?= Html::a(
            'Отмена',
            empty(Yii::$app->request->referrer) ? ['/moderator/partner-list'] : Yii::$app->request->referrer,
            ['class' => 'btn btn-blue btn-step']
        ); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>