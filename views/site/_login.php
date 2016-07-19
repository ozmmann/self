<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="f-30 fw-semi-bold">Вход для партнеров</div>
<?php $form = ActiveForm::begin([
    'id' => 'login_form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
]); ?>

<div class="row mtop-20">
    <?= $form->field($model, 'login')
        ->textInput([
            'autofocus' => true,
            'id' => 'login',
            'placeholder' => 'email@localhost.com'
        ])
        ->label('Email:') ?>
</div>
<div class="row mtop-20 pos-rel">
    <?= $form->field($model, 'password')
        ->passwordInput([
            'id' => 'password',
            'placeholder' => "•••••••••"
        ])
        ->label('Пароль:<a href="#" class="show-password sm-hide"></a>') ?>

</div>
<div class="db checkbox-list mtop-20">
    <?= Html::activeCheckbox(
        $model,
        'rememberMe',
        [
            'label' => '<i></i><span>Запомните меня</span>',
            'labelOptions' => ['class' => 'vam w-68']
        ]);
    ?><i></i>
    <?= Html::a('Забыл пароль', ['site/restore-password-request'], ['class' => 'dib vam w-30 text-right']) ?>
</div>

<div class="mtop-20 cta">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-blue', 'name' => 'login-button']) ?>
    <?= Html::a('Регистрация', ['site/registration'], ['class' => 'pull-right mtop-15']) ?>
</div>
<?php ActiveForm::end(); ?>
<?php $this->registerJs('
    $("#login_form").on("beforeSubmit", function(event, jqXHR, settings) {
        var form = $(this);
        if(form.find(".has-error").length) {
            return false;
        }

        $.ajax({
            url: form.attr("action"),
            type: "post",
            data: form.serialize(),
            success: function(data) {
                $("#login_popup").find("#modalContent")
                    .html(data);
                $(".show-password").click(function () {
                    var password_input = $(this).parent().siblings("#password"),
                        type = password_input.attr("type");
                    if(type == "text"){
                        password_input.attr("type", "password");
                    } else if(type == "password"){
                        password_input.attr("type", "text");
                    }
                });
            }
        });

        return false;
    })
');