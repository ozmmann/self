<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($cityForm, 'name')->label('Город') ?>
        <?= $form->field($cityForm, 'notGhost')
                 ->checkbox(['label' => '<span>Регион(не призрак)<span>', 'labelOptions' => ['class' => 'checkbox-inline']]) ?>
        <?= Html::submitButton('Сохранить') ?>
        <?= Html::a(
            'Отмена',
            empty(Yii::$app->request->referrer) ? ['/moderator/partner-list'] : Yii::$app->request->referrer
        ); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>