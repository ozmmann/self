<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

    $this->title = 'Редактировать акцию';
    $this->registerJsFile('js/formStock.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/map.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/pickdate/picker.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/pickdate/picker.date.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/pickdate/ru_RU.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/nouislider.min.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/wNumb.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places');
    $this->registerCssFile('css/pickdate/classic.css');
    $this->registerCssFile('css/nouislider.min.css');
    $this->registerCssFile('css/pickdate/classic.date.css');
?>
<div id="construtor_page">
    <div class="container md-text-center f-0">
        <? include_once("constructor/sidebar.php"); ?>
        <? include_once("constructor/preview.php"); ?> <!-- preview-no-data -->
    </div>
</div>

<? // include_once("problems.php"); ?>


