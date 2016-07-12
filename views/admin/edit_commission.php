<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /** @var \app\models\forms\CommissionForm $model */
    /** @var array $categoryList */
?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'stockCategoryId')
                 ->label('Категория акций')
                 ->dropDownList($categoryList, ['prompt' => '', 'data-placeholder' => 'Выберите категорию']) ?>
        <h2>Регион</h2>
        <?= $form->field($model, 'percentRegion')
                 ->label('Процент за размещение')
                 ->input('float') ?>
        <?= $form->field($model, 'fixedRegion')
                 ->label('Фиксируемая стоимость')
                 ->input('float') ?>
        <?= $form->field($model, 'freeRegion')
                 ->label('Процент для бесплатного размещения')
                 ->input('float') ?>

        <h2>Призрак</h2>
        <?= /** @var \app\models\Commission $modelGhost */
            $form->field($model, 'percentGhost')
                 ->label('Процент за размещение')
                 ->input('float') ?>
        <?= $form->field($model, 'fixedGhost')
                 ->label('Фиксируемая стоимость')
                 ->input('float') ?>
        <?= $form->field($model, 'freeGhost')
                 ->label('Процент для бесплатного размещения')
                 ->input('float') ?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-yellow btn-next-step']) ?>
        <?= Html::a('Отмена', ['/admin/commission-list'], ['class' => 'btn btn-blue btn-step']); ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>