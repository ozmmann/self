<?php

    use app\models\City;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\Pjax;

?>


<? //= $this->render('_search', ['model' => $searchModel]) ?>
<div class="row">
    <div class="col-md-12">
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
                                 'dataProvider' => $partnerProvider,
                                 'columns'      => [
                                     ['class' => 'yii\grid\SerialColumn'],

                                     'name:text:Имя',
                                     [
                                         'label'   => 'Телефоны',
                                         'value'   => function($model){
                                             return $model->secondPhone ? $model->phone.', '.$model->secondPhone : $model->phone;
                                         },
                                         'options' => ['width' => '200']
                                     ],
                                     'email:email',
                                     [
                                         'attribute' => 'status',
                                         'label'     => Yii::$app->params['userStatusLabel'],
                                         'content'   => function($model){
                                             return Yii::$app->params['userStatus'][$model->status];
                                         },
                                         'filter'    => Yii::$app->params['userStatus']
                                     ],
                                     [
                                         'attribute' => 'cityId',
                                         'label'     => 'Город',
                                         'value'     => 'city.name',
                                         'filter'    => $cityList,
                                     ],
                                     [
                                         'attribute' => 'stockTypeId',
                                         'label'     => 'Категория услуг',
                                         'value'     => 'stockType.name',
                                         'filter'    => $stockTypeList,
                                     ],
                                     [
                                         'class'    => 'yii\grid\ActionColumn',
                                         'buttons'  => [
                                             'view'   => function($url, $model){
                                                 return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [
                                                     'partner',
                                                     'id' => $model->id
                                                 ], ['title' => 'Детально']);
                                             },
                                             'update' => function($url, $model){
                                                 return Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                                                     'edit-partner',
                                                     'id' => $model->id
                                                 ], ['title' => 'Редактировать']);
                                             },
                                             'delete' => function($url, $model){
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
                                 'filterModel'  => $searchModel,
                                 'showHeader'   => true,
                             ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
