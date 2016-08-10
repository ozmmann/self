<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="f-30 fw-semi-bold">Ссылка на акцию</div>
<?php $form = ActiveForm::begin([
    'id' => 'link_form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'action' => '/moderator/modal-add-stock-link'
]); ?>

<?= $form->field($model, 'id')
    ->hiddenInput(['id' => 'stock_data_id'])->label(false) ?>

<div class="row mtop-20">
    <?= $form->field($model, 'link')
        ->input('url',[
            'autofocus' => true,
            'id' => 'link'
        ])
        ->label('Ссылка:') ?>
</div>

<div class="mtop-20 cta">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-blue', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>

