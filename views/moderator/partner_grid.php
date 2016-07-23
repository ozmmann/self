<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/** @var Model $searchModel */
/** @var ActiveDataProvider $partnerProvider */
/** @var array $cityList */
/** @var array $stockTypeList */

$title = isset($title) ? $title : 'Список партнеров';

$this->title = $title;

?>


<? //= $this->render('_search', ['model' => $searchModel]) ?>
<div class="container">
    <div class="w-85 m-auto wrapper">
        <h3><?= $title ?></h3>

        <?php Pjax::begin(); ?>

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
                    'filter' => Yii::$app->params['userStatus']
                ],
                [
                    'attribute' => 'cityId',
                    'label' => 'Город',
                    'value' => 'city.name',
                    'filter' => $cityList,
                ],
                [
                    'attribute' => 'stockTypeId',
                    'label' => 'Категория услуг',
                    'value' => 'stockType.name',
                    'filter' => $stockTypeList,
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
            'filterModel' => $searchModel,
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
