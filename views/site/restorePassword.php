<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановить пароль';
$this->params['breadcrumbs'][] = $this->title;
BootstrapAsset::register($this);
?>

<div class="site-login">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Введите Ваш email для восстановления пароля:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'restore-form', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ],
            ]); ?>
            <?= $form->field($model, 'email')
                ->input('email')
                ->label('Email') ?>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <?= Html::submitButton('Restore', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

