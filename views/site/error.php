<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
$name = $name == 'Exception' ? 'Ошибка' : $name;
$this->title = $name;
BootstrapAsset::register($this);
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Произошла ошибка при обработке Вашего запроса.
    </p>
    <p>
        Свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.
    </p>

</div>
