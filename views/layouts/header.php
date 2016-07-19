<div id="header">
    <div class="container">
        <div class="w-100 text-center pos-rel">
            <a href="<?= Yii::$app->user->isGuest
                ? Yii::$app->homeUrl
                : '/' . Yii::$app->user->identity->getRole() . "/index" ?>" class="logo"><b>P</b>okupon <b>&
                    S</b>uper<b>D</b>eal</a>

            <?php
                $menu = Yii::$app->user->isGuest ? 'guest_header.php' : Yii::$app->user->identity->getRole() . '_header.php';
                include_once($menu);
            ?>
        </div>
    </div>
</div>