<?php
use yii\helpers\Html;

return [
    !Yii::$app->user->isGuest ? (['label' => 'Профиль', 'url' => '/' . Yii::$app->user->identity->getRole()]) : '',
    Yii::$app->user->isGuest ? (
    ['label' => 'Войти', 'url' => ['/site/login'], 'options' => ['class' => 'btn-login']]
    )
        :
        (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link btn-logout']
            )
            . Html::endForm()
            . '</li>'
        ),
    Yii::$app->user->isGuest ? (
    ['label' => 'Начать', 'url' => ['/site/registration'], 'options' => ['class' => 'btn-register']]
    ) : (''),
];
