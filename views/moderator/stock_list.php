<?php

    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\widgets\Pjax;

    $title = isset($title) ? $title : 'Список акций';
    $this->registerJsFile('js/updateStatus.js', ['depends' => 'app\assets\AppAsset']);
?>
<div class="row">
    <div class="col-md-12">
        <h3><?= $title ?></h3>
    </div>
</div>
<div class="row">

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
                             'dataProvider' => $stockProvider,
                             'columns'      => [
                                 ['class' => 'yii\grid\SerialColumn'],

                                 'title:text:Название акции',
                                 [
                                     'label'     => 'Пользователь',
                                     'value'     => 'user.name',
                                     'attribute' => 'userName',
                                 ],
                                 'user.email:text:Email',
                                 [
                                     'attribute' => 'status',
                                     'label'     => Yii::$app->params['stockStatusLabel'],
                                     'content'   => function($model){
                                         return Yii::$app->params['stockStatus'][$model->status];
                                     },
                                     'filter'    => Yii::$app->params['stockStatus']
                                 ],
                                 [
                                     'attribute' => 'startDate',
                                     'label'     => 'Дата старта',
                                     'format'    => ['date', 'dd.MM.Y'],
                                     'options'   => ['width' => '100']
                                 ],
                                 [
                                     'attribute'     => 'cityId',
                                     'label'         => 'Город',
                                     'value'         => 'user.city.name',
                                     'filter'        => $cityList,
                                     'filterOptions' => ['class' => 'chosen-wrap'],
                                 ],
                                 [
                                     'attribute'     => 'category',
                                     'label'         => 'Категория',
                                     'value'         => 'stockCategory.name',
                                     'filter'        => $categoryList,
                                     'filterOptions' => ['class' => 'chosen-wrap'],
                                 ],
                                 [
                                     'class'   => 'yii\grid\ActionColumn',
                                     'buttons' => [
                                         'view'   => function($url, $model){
                                             return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [
                                                 'stock',
                                                 'id' => $model->id
                                             ], ['title' => 'Детально']);
                                         },
                                         'update' => function($url, $model){
                                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                                                 'edit-stock',
                                                 'id' => $model->id
                                             ], ['title' => 'Редактировать']);
                                         },
                                         'delete' => function($url, $model){
                                             return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                                 'delete-stock',
                                                 'id' => $model->id
                                             ], ['title' => 'Удалить']);
                                         },
                                     ],
                                     'contentOptions' => ['class' => 'action-column'],
                                 ],
                                 [
                                     'class'   => 'yii\grid\ActionColumn',
                                     'header'  => 'Изменить статус',
                                     'buttons' => [
                                         'select' => function($url, $model){
                                             return Html::dropDownList('status', $model->status, Yii::$app->params['stockStatus'], [
                                                 'data-id' => $model->id,
                                                 'class'   => 'changeStatus'
                                             ]);
                                         },
                                     ],
                                     'template' => '{select}',

                                 ],
                             ],
                             'filterModel'  => $searchModel,
                             'showHeader'   => true,
                         ]) ?>
    <?php Pjax::end(); ?>
</div>


