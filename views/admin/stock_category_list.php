<?php

    use yii\helpers\Html;
    use yii\widgets\Pjax;

?>
<style>
    .list-group-item.active a {
        color: white;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <?php Pjax::begin() ?>
        <?= Html::beginForm('stock-category-list', 'get', ['class' => 'form-inline']) ?>
        <?= Html::input('text', 'nameSerch', Yii::$app->request->post('nameSerch'), ['class' => 'form-control']) ?>
        <?= Html::submitButton('Найти', ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::endForm() ?>
        <?php Pjax::end() ?>

        <?= Html::a('Добавить', ['edit-stock-category']) ?>
        <div class="list-group">
            <?php foreach($stockCategorys as $item): ?>

                <?php
                //кнопочки удалить и редактировать
                $edit = Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                    'edit-stock-category',
                    'id' => $item->id
                ], ['title' => 'Редактировать']);
                //                $delete = Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                //                    'delete-stock-category',
                //                    'id' => $item->id
                //                ], ['title' => 'Удалить']);
                //количество детей
                $span = Html::tag('span', $item->countChild, ['class' => 'badge']);
                if($selectId == $item->id){
                    $class = 'list-group-item active';
                }else{
                    $class = 'list-group-item';
                }
                ?>
                <div class="<?= $class ?>">
                    <?= Html::a($item->name, ['/admin/stock-category-list', 'id' => $item->id], ['class' => 'col-sm-11']) ?>
                    <?= $span ?>
                    <?= $edit ?>
                    <!--                    --><? //= $delete ?>
                </div>
                <?php if($selectId == $item->id): ?>
                    <?php foreach($children as $child): ?>
                        <?php
                        //кнопочки удалить и редактировать
                        $edit = Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                            'edit-stock-category',
                            'id' => $child->id
                        ], ['title' => 'Редактировать']);
                        //                        $delete = Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                        //                            'delete-stock-category',
                        //                            'id' => $child->id
                        //                        ], ['title' => 'Удалить']);
                        //количество детей

                        $span = Html::tag('span', $child->countChild, ['class' => 'badge']);
                        if($selSubId == $child->id){
                            $subclass = ' active';
                        }else{
                            $subclass = '';
                        } ?>
                        <div class="col-sm-offset-2 list-group-item <?= $subclass ?>">
                            <?= Html::a($child->name, [
                                '/admin/stock-category-list',
                                'id'    => $item->id,
                                'subid' => $child->id
                            ], ['class' => 'col-sm-11']) ?>
                            <?= $span ?>
                            <?= $edit ?>
                            <!--                            --><? //= $delete ?>
                        </div>
                        <? if($selSubId == $child->id): ?>
                            <?php foreach($subchildren as $sub_child): ?>
                                <?php
                                //кнопочки удалить и редактировать
                                $edit = Html::a('<span class="glyphicon glyphicon-pencil"></span>', [
                                    'edit-stock-category',
                                    'id' => $sub_child->id
                                ], ['title' => 'Редактировать']);
                                //                                $delete = Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                //                                    'delete-stock-category',
                                //                                    'id' => $sub_child->id
                                //                                ], ['title' => 'Удалить']);
                                //количество детей
                                $span = Html::tag('span', $sub_child->countChild, ['class' => 'badge'])
                                ?>
                                <div class="col-sm-offset-4 list-group-item">
                                    <?= Html::a($sub_child->name, ['/admin/stock-category-list', 'id' => $sub_child->id], ['class' => 'col-sm-11']) ?>
                                    <?= $span ?>
                                    <?= $edit ?>
                                    <!--                                    --><? //= $delete ?>
                                </div>
                            <?php endforeach; ?>
                        <? endif ?>
                    <?php endforeach; ?>
                <? endif ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>