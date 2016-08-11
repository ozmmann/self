<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановить пароль';
?>

<div id="construtor_page">
    <div class="container">
        <div id="user-form">
            <div class="container">
                <div class="form_wrap w-85 m-auto">
                    <h1 class="ttu f-32 fw-bold text-center"><?= Html::encode($this->title) ?></h1>

                    <div class="text f-14 ttu text-center">Введите новый пароль:</div>

                    <div class="cols mtop-80 f-14">

                        <?php $form = ActiveForm::begin([
                            'id' => 'newpasswordform'
                        ]); ?>
                        <?= $form->field($model, 'password')
                            ->input('password', ['class'=>'w-60'])
                            ->label('Новый пароль', ['class'=>'w-60']) ?>

                        <div class="db mtop-40">
                            <?= Html::submitButton('Дальше', ['class' => 'btn btn-yellow btn-next-step']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

