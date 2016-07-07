<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

?>

    <div class="site-login">
        <div class="row text-center">
            <h1>Укажите Ваши данные</h1>
            <p>ВСЯ ИНФОРМАЦИЯ КОНФЕДЕНЦИАЛЬНА И НЕ БУДЕТ ПЕРЕДАНА ТРЕТЬИМ ЛИЦАМ.</p>
        </div>
        <div class="row form-login">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin([
                                                    'id'          => 'reg-form',
                                                    'options'     => ['class' => 'form-horizontal'],
                                                    'fieldConfig' => [
                                                        //                    'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                                                        //                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                                                    ],
                                                ]); ?>
                <?= $form->field($model, 'name')
                         ->textInput(['placeholder' => 'Фамилия Имя Очество'])
                         ->label('Укажите ФИО'); ?>
                <?= $form->field($model, 'phone')
                         ->input('tel', ['placeholder' => '+380 (ХХ) ХХХ-ХХ-ХХ'])
                         ->label('Контактный телефон'); ?>
                <div class="form-group">
                    <button id="addSecondPhone" class="btn btn-secondary"><span
                            class="glyphicon glyphicon-plus-sign"></span>
                        Добавить еще один
                    </button>
                </div>
                <div id="secondPhoneWrapper" class="hidden">
                    <?= $form->field($model, 'secondPhone')
                             ->label('Контактный телефон 2')
                             ->input('tel', ['placeholder' => '+380 (ХХ) ХХХ-ХХ-ХХ']); ?>
                </div>
                <?= $form->field($model, 'email')
                         ->input('email', ['placeholder' => 'E-mail@name.com'])
                         ->label('Email') ?>
                <?= $form->field($model, 'cityId')
                         ->label('Город')
                         ->dropDownList(ArrayHelper::map($cityList, 'id', 'name'), ['class'            => 'chosen',
                                                                                    'prompt'           => '',
                                                                                    'data-placeholder' => "Выберите город..."
                         ]) ?>
                <?= $form->field($model, 'password_repeat')
                         ->label('Пароль')
                         ->passwordInput() ?>
                <?= $form->field($model, 'password')
                         ->label('Повторите пароль')
                         ->passwordInput() ?>
                <?= $form->field($model, 'stockTypeId')
                         ->label('Категория услуг')
                         ->dropDownList(ArrayHelper::map($stockTypeList, 'id', 'name'), [
                             'class'            => 'chosen',
                             'prompt'           => '',
                             'data-placeholder' => 'Выберите категорию услуг'
                         ]) ?>



                <?= $form->field($model, 'site')
                         ->label('Адрес вашего сайта')
                         ->input('url', ['placeholder' => 'www.site_name.com']); ?>
                <div>
                    <?php
                        $label = '<span>Вы принимаете'.' '.Html::a('Пользовательское соглашение', '/site/pages?view=eula', ['target' => '_blank']).'</span>';
                    ?>
                    <?= $form->field($model, 'agree')
                             ->checkbox()
                             ->label($label); ?>
                </div>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Дальше &#8594;', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4 col-md-offset-2 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Сверхприбыльный маркетинг</h3>
                        <p>
                            Более 1 миллиона покупателей <br>
                            приобрели купоны у нас <br>
                            на портале и стали активными <br>
                            клиентами наших партнеров. <br>
                            Более 80% запущенных акций <br>
                            стали успешными.<br>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>У нас активные пользователи</h3>
                        <p>
                            Наши пользователи лояльны <br>
                            к местам , которые они любят. <br>
                            Они будут рекомендовать <br>
                            любимые места друзьям. <br>
                            Просто удивите их.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Мы новый канал роста</h3>
                        <p>Начните продавать в интернете <br>
                            еще больше. Разместие одну <br>
                            акцию и вы получите аудиторию <br>
                            более 2 млн. человек</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
    $this->registerJs("
    $('#addSecondPhone').click(function () {
        $('#secondPhoneWrapper').removeClass('hidden');
        $(this).prop('disabled', true);
    });
    ");
?>