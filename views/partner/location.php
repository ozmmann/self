<?php

    use app\models\City;
    use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

    $this->title = 'Create Stock';
    $this->registerJsFile('js/formStock.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('js/map.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerJsFile('https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places');
    $this->registerCssFile('css/formStock.css', ['depends' => 'app\assets\AppAsset']);

?>

<?php $form = ActiveForm::begin() ?>
<?= Html::activeHiddenInput($locationForm, 'address') ?>
<?= $form->field($locationForm, 'city')
         ->label('Город') ?>
<?= $form->field($locationForm, 'address')
         ->label('Адрес') ?>
<?= $form->field($locationForm, 'phone')
         ->label('Телефон')
         ->input('tel') ?>

    <div id="locations" data-locations-count="1">
        <div class="location">
            <?= Html::textInput('address', null, ['class' => 'form-control', 'id' => 'address']) ?>
            <?= Html::textInput('city', null, ['class' => 'form-control', 'id' => 'city1']) ?>
            <?= Html::textInput('phone', null, ['class' => 'form-control', 'id' => 'phone1']) ?>
        </div>
    <button id="addlocation" type="button" class="btn btn-secondary">Добавить локацию</button>
    </div>

    <div class="row g-map">
        <div class="col-md-12">
            <span class="info-header">Где находится:</span>
        </div>
        <div class="col-md-12">
            <div id="map_canvas"></div>
        </div>
    </div>
<?php ActiveForm::end(); ?>