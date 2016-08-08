<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\StockAsset;

StockAsset::register($this);
$this->title = 'Редактировать акцию';

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCQ56BL9X6RHsTYWpcvb-s8Y82jNWrJa7A');
?>
<div id="construtor_page">
    <div class="container md-text-center f-0">
        <? include_once("constructor/sidebar.php"); ?>
        <? include_once("constructor/preview.php"); ?> <!-- preview-no-data -->
    </div>
</div>

<? // include_once("problems.php"); ?>


