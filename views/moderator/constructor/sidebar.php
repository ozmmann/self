<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

?>

<div id="sidebar" class="dib vat w-31 w-md-80 w-sm-100 md-text-left">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
        include_once("steps/step-1.php");
    ?>
    <?php
        include_once("steps/step-2.php");
    ?>
    <?php
        include_once("steps/step-3.php");
    ?>
    <?php
        include_once("steps/step-4.php");
    ?>
    <?php
        include_once("steps/step-5.php");
    ?>
    <?php
        include_once("steps/step-6.php");
    ?>
    <?php
        include_once("steps/step-7.php");
    ?>
    <?php
        include_once("steps/step-8.php");
    ?>
    <?php ActiveForm::end(); ?>
</div>
<div class="dib w-4 md-hide sm-hide"></div>