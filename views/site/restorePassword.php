<?php

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановить пароль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="construtor_page">
    <div class="container">
        <div id="user-form">
            <div class="container">
                <div class="form_wrap w-85 m-auto">
                    <h1 class="ttu f-32 fw-bold text-center"><?= Html::encode($this->title) ?></h1>

                    <div class="text f-14 ttu text-center">Введите Ваш email для восстановления пароля:</div>

                    <div class="cols mtop-80 f-14">

                        <?php $form = ActiveForm::begin([
                            'id' => 'restore-form', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
//                                'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
//                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                        ]); ?>
                        <?= $form->field($model, 'email')
                            ->input('email', ['class'=>'w-60'])
                            ->label('Email', ['class'=>'w-60']) ?>

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

