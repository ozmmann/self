<div class="row">
    <div class="col-md-12">
        <table class="table-striped col-sm-12">
            <tr>
                <th></th>
                <th>Название</th>
                <th>Статус</th>
                <th>Размер скидки</th>
                <th>Цена</th>
                <th>Тип коммисии</th>
                <th>Значение коммисии</th>
                <th>Сайт</th>
                <th></th>
            </tr>
            <tr>
                <td><img src="<?= $stock->picture ?>" alt="<?= $stock->title ?>" height="80px"></td>
                <td><?= $stock->title ?></td>
                <td><?= Yii::$app->params['stockStatus'][$stock->status] ?></td>
                <td><?= $stock->discount ?></td>
                <td><?= $stock->price ?></td>
                <td><?= Yii::$app->params['commissionType'][$stock->commissionType] ?></td>
                <td><?= $stock->commissionValue ?></td>
                <td><?= $stock->site ?></td>
                <td>
                    <a href="<?= Yii::$app->urlManager->createUrl(['moderator/edit-stock', 'id' => $stock->id]) ?>">Edit</a>
                </td>
            </tr>
        </table>
        <?php if (is_null($stock)): ?>
            <h4>Нет активных акций</h4>
        <?php endif; ?>
    </div>
</div>
