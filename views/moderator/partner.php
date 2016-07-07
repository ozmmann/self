<?php
   
?>
<div class="row">
    <table class="table-striped col-sm-12">
        <th>Имя</th>
        <th>Телефоны</th>
        <th>Email</th>
        <th>Статус</th>
        <th>Город</th>
        <th>Категория услуг</th>
        <tr>
            <td><?= $partner->name ?></td>
            <td><?= $partner->phone ?></td>
            <td><?= $partner->email ?></td>
            <td><?= Yii::$app->params['userStatus'][$partner->status] ?></td>
            <td><?= $partner->getCityName() ?></td>
            <td><?= $partner->getStockTypeName() ?></td>
            <td>
                <a href="<?= Yii::$app->urlManager->createUrl(['moderator/edit-partner', 'id' => $partner->id]) ?>">Edit</a>
            </td>
        </tr>
    </table>
    <?php if(is_null($partner)): ?>
        <h1>партнер призрак!!!</h1>
    <?php endif; ?>
</div>