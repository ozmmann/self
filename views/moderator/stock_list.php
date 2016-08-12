<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$title = isset($title) ? $title : 'Список акций';
$this->title = $title;
$this->registerJsFile('js/updateStatus.js', ['depends' => 'app\assets\AppAsset']);
?>

<div class="container">
    <div class="w-85 m-auto wrapper">
        <h3><?= $title ?></h3>

        <?php Pjax::begin(); ?>
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
                    'filter' => Yii::$app->params['stockStatus']
                ],
                [
                    'attribute' => 'startDate',
                    'label' => 'Дата старта',
                    'format' => ['date', 'dd.MM.Y'],
                    'options' => ['width' => '100']
                ],
                [
//                    'attribute' => 'cityId',
                    'label' => 'Город',
//                    'value' => 'user.city.name',
//                    'filter' => $cityList,
                    'content' => function ($model) {
                        $cities = '';
                        if($model->location['city']){
                            $cities = implode(", ", $model->location['city']);
                        }
                        return $cities;
                    },
//                    'filterOptions' => ['class' => 'chosen-wrap'],
                ],
                [
                    'attribute' => 'category',
                    'label' => 'Категория',
                    'value' => 'stockCategory.name',
                    'filter' => $categoryList,
                    'filterOptions' => ['class' => 'chosen-wrap'],
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
                        'addlink' => function ($url, $model) {
                            return "<a class='stockpopup-with-form' data-stock-id='". $model->id ."' href='#link_popup' title='Удалить'><span class='glyphicon glyphicon-link'></span></a>";
                        },
                    ],
                    'template' => '{view}{update}{delete}{addlink}',
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
        ]) ?>
        <?php Pjax::end(); ?>
        <div class="mfp-hide popup-data" id="link_popup">
            <div class="popup-data">
                <div class="content">
                    <div class="f-15 fw-semi-bold">Загрузка...</div>
                </div>
            </div>
        </div>
    </div>
</div>


