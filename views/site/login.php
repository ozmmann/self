<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div id="construtor_page">
    <div class="container">
        <div id="user-form">
            <div class="container">
                <div class="form_wrap w-85 m-auto">
                    <h1 class="ttu f-32 fw-bold text-center">Укажите ваши данные</h1>
                    <div class="text f-14 ttu text-center">Вся информация конфиденциальна и не будут переданы
                        третьим
                        лицам.
                    </div>
                    <div class="cols f-0 mtop-80">
                        <div class="dib w-50 w-sm-100 w-md-80 vat f-14 m-auto md-db">
                            <?php $form = ActiveForm::begin([
                                'id' => 'reg-form',
                                'options' => ['class' => 'form-horizontal'],
                                'fieldConfig' => [
                                    //                    'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                                    //                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                                ],
                            ]); ?>

                            <?= $form->field($model, 'login')
                                ->textInput(['autofocus' => true, 'class' => 'w-60'])
                                ->label('Email') ?>

                            <?= $form->field($model, 'password')
                                ->passwordInput(['class' => 'w-40'])
                                ->label('Пароль') ?>

                            <div style="color:#999;margin:1em 0">
                                Забыли пароль? <?= Html::a('Восстановить', ['site/restore-password-request']) ?>.
                            </div>

                            <div class="db mtop-40">
                                <?= Html::submitButton('Дальше', ['class' => 'btn btn-yellow btn-next-step', 'name' => 'login-button']) ?>

                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="dib w-50 w-sm-100 w-md-100 vat mtop-sm-40 mtop-md-60 f-14 text-center">
                            <div class="dib w-50 w-sm-100 w-md-80">
                                <div class="f-26">Сверхприбыльный
                                    маркетинг
                                </div>
                                <div class="text lh-1-4 mtop-20">
                                    Более 1 миллиона покупателей приобрели купоны у нас
                                    на портале и стали активными клиентами наших партнеров. Более 80% запущенных
                                    акций
                                    стали
                                    успешными.
                                </div>
                            </div>
                            <div class="dib w-50 w-sm-100 w-md-80 mtop-60">
                                <div class="f-26">У нас активные
                                    пользователи
                                </div>
                                <div class="text lh-1-4 mtop-20">
                                    Наши пользователи лояльны
                                    к местам , которые они любят.
                                    Они будут рекомендовать любимые места друзьям.
                                    Просто удивите их.
                                </div>
                            </div>
                            <div class="dib w-50 w-sm-100 w-md-80 mtop-60">
                                <div class="f-26">Мы новый
                                    канал роста
                                </div>
                                <div class="text lh-1-4 mtop-20">
                                    Начните продавать в интернете еще больше. Разместие одну акцию и вы получите
                                    аудиторию более
                                    2 млн. человек
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
