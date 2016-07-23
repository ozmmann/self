<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var ActiveDataProvider $partnerProvider */
/** @var ActiveDataProvider $stockProvider */

$this->registerJsFile('js/updateStatus.js', ['depends' => 'app\assets\AppAsset']);
$this->title = 'Dashboard';
?>

<div class="container">
    <div class="w-85 m-auto wrapper">
        <?php Pjax::begin(); ?>

        <h1><?= Html::a('Все акции', '/moderator/stock-list') ?></h1>
        <?= GridView::widget([
            'dataProvider' => $stockProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title:text:Название акции',
                [
                    'label' => 'Пользователь',
                    'value' => 'user.name',
                    'attribute' => 'userName',
                ],
                'user.email:text:Email',
                [
                    'attribute' => 'status',
                    'label' => Yii::$app->params['stockStatusLabel'],
                    'content' => function ($model) {
                        return Yii::$app->params['stockStatus'][$model->status];
                    },
                ],
                [
                    'attribute' => 'startDate',
                    'label' => 'Дата старта',
                    'format' => ['date', 'dd.MM.Y'],
                    'options' => ['width' => '100']
                ],
                [
                    'attribute' => 'cityId',
                    'label' => 'Город',
                    'value' => 'user.city.name',
                ],
                [
                    'attribute' => 'category',
                    'label' => 'Категория',
                    'value' => 'stockCategory.name',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [
                                'stock',
                                'id' => $model->id
                            ], ['title' => 'Детально']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                                'edit-stock',
                                'id' => $model->id
                            ], ['title' => 'Редактировать']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                'delete-stock',
                                'id' => $model->id
                            ], ['title' => 'Удалить']);
                        },
                    ],
                    'contentOptions' => ['class' => 'action-column'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Изменить статус',
                    'buttons' => [
                        'select' => function ($url, $model) {
                            return Html::dropDownList('status', $model->status, Yii::$app->params['stockStatus'], [
                                'data-id' => $model->id,
                                'class' => 'changeStatus'
                            ]);
                        },
                    ],
                    'template' => '{select}',

                ],
            ],
            'showHeader' => true,
            'pager' => [
                'prevPageLabel' => '&larr;',
                'nextPageLabel' => '&rarr;',
                'disabledPageCssClass' => 'btn',
                'linkOptions' => [
                    'class' => 'btn'
                ]
            ],
//            'summary' => "{begin} - {end} {count} {totalCount} {page} {pageCount}",
//            'layout'=>"{items}\n{pager}\n{summary}"
        ]) ?>
        <h1><?= Html::a('Все партнеры', '/moderator/partner-list') ?></h1>
        <?= GridView::widget([
            'dataProvider' => $partnerProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name:text:Имя',
                [
                    'label' => 'Телефоны',
                    'value' => function ($model) {
                        return $model->secondPhone ? $model->phone . ', ' . $model->secondPhone : $model->phone;
                    },
                    'options' => ['width' => '200']
                ],
                'email:email',
                [
                    'attribute' => 'status',
                    'label' => Yii::$app->params['userStatusLabel'],
                    'content' => function ($model) {
                        return Yii::$app->params['userStatus'][$model->status];
                    },
                ],
                [
                    'attribute' => 'cityId',
                    'label' => 'Город',
                    'value' => 'city.name',
                ],
                [
                    'attribute' => 'stockTypeId',
                    'label' => 'Категория услуг',
                    'value' => 'stockType.name',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [
                                'partner',
                                'id' => $model->id
                            ], ['title' => 'Детально']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                                'edit-partner',
                                'id' => $model->id
                            ], ['title' => 'Редактировать']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                'delete-partner',
                                'id' => $model->id
                            ], ['title' => 'Удалить']);
                        },
                    ],
                    'template' => '{view}{update}',
                    'contentOptions' => ['class' => 'action-column'],

                ],
            ],
            'showHeader' => true,
            'pager' => [
                'prevPageLabel' => '&larr;',
                'nextPageLabel' => '&rarr;',
                'disabledPageCssClass' => 'btn',
                'linkOptions' => [
                    'class' => 'btn'
                ]
            ]
        ]); ?>
        <?php Pjax::end(); ?>

    </div>
</div>
