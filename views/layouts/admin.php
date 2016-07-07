<?php
use yii\helpers\Html;

return [
    [
        'label' => 'Меню',
        'items' => [
            ['label' => 'Города', 'url' => '/admin/city-list'],
            ['label' => 'Комиссии', 'url' => '/admin/commission-list'],
            ['label' => 'Категории', 'url' => '/admin/stock-category-list'],
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