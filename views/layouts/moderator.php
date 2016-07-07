<?php
use yii\helpers\Html;

return [
    [
        'label' => 'Меню',
        'items' => [
            ['label' => 'Dashboard', 'url' => '/moderator/'],
            ['label' => 'Все Акции', 'url' => '/moderator/stock-list'],
            ['label' => 'Все Пользователи', 'url' => '/moderator/partner-list'],
            ['label' => 'Профиль', 'url' => '/' . Yii::$app->user->identity->getRole() . "/profile"],
            '<li class="divider"></li>',
            Yii::$app->user->isGuest ? (
            ['label' => 'Войти', 'url' => ['/site/login']]
            )
                :
                (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->name . ')',
                        ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>'
                ),
        ],
    ],
    Yii::$app->user->isGuest ? (
    ['label' => 'Начать', 'url' => ['/site/registration']]
    ) : (''),
];