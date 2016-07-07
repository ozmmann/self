<?php

    use yii\helpers\Html;
    use yii\widgets\LinkPager;
    use yii\widgets\Pjax;

    $title = isset($title) ? $title : 'Список партнеров';

    
?>
<div class="row">
    <h2>Partner</h2>

    <?php Pjax::begin() ?>
    <?= Html::beginForm('partner-list', 'post', ['class' => 'form-inline']) ?>
    <?= Html::radioList('chkSel', Yii::$app->request->post('chkSel'), ['имя', 'тел', 'e-mail', 'категория услуг'], ['class' => 'form-control']) ?>
    <?= Html::input('text', 'nameSerch', Yii::$app->request->post('nameSerch'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Найти', ['class' => 'btn btn-lg btn-primary']) ?>
    <?= Html::endForm() ?>
    
    <?php if(count($partners)): ?>
        <table class="table-striped col-sm-12">
            <th>Имя</th>
            <th>Телефоны</th>
            <th>Email</th>
            <th>Статус</th>
            <th>Город</th>
            <th>Категория услуг</th>
            <th></th>
            <?php foreach($partners as $partner): ?>
                <tr>
                    <td><?= $partner->name ?></td>
                    <td><p><?= $partner->phone ?></p>
                        <p><?= $partner->secondPhone ?></p></td>
                    <td><?= $partner->email ?></td>
                    <td><?= $partner->status ?></td>
                    <td><?= $partner->getCityName() ?></td>
                    <td><?= $partner->getStockTypeName() ?></td>

                    <td>
                        <?= Html::a('Detail', ['moderator/partner', 'id' => $partner->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('Edit', ['moderator/edit-partner', 'id' => $partner->id], ['class' => 'btn btn-success']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h1>Список партнеров пуст</h1>
    <?php endif; ?>
</div>
<?= LinkPager::widget(['pagination' => $pagination]); ?>
<?php Pjax::end() ?>
