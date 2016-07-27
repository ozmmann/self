<?php

    use yii\helpers\Html;

    /* @var $locationForm app\models\forms\LocationForm */

    $user = \app\models\User::findOne(Yii::$app->user->id);
?>
<div class="row">
    <a href="#" class="row-title">Укажите место проведения</a>
    <div class="row-content">
        <?php
            $locations_count = count($locationForm->address); ?>
            <div id="locations" data-locations-count="<?= $locations_count ?>">
            <?php
                for($i = 0; $i < $locations_count; $i++): ?>
                    <div id="locations_<?= $i ?>" class="address-row">
                        <div class="required-field">
                            <?= Html::textarea('LocationForm[address][]', $locationForm->address[$i], [
                                'class'       => 'w-100 address',
                                'placeholder' => 'ул. Парашютная 12/14 1',
                                'id'          => 'address_' . $i
                            ]) ?>
                            <div class="form-error-msg"></div>
                        </div>
                        <div class="f-0 mtop-20">
                            <div class="dib w-50 f-14">
                                <?= Html::textInput('LocationForm[city][]', $locationForm->city[$i], [
                                    'class'       => 'w-85 city',
                                    'placeholder' => 'Киев',
                                    'disabled' => true,
                                    'id' => 'city_address_' . $i
                                ]) ?>
                            </div>
                            <div class="dib w-50 f-14 text-right">
                                <?= Html::textInput('LocationForm[phone][]', $locationForm->phone[$i], [
                                    'class'       => 'w-100 phone',
                                    'placeholder' => '+380 (ХХ) ХХХ-ХХ-ХХ',
//                                    'pattern'     => '/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/',
                                    'id' => 'phone_address_' . $i
                                ]) ?>
                            </div>
                        </div>
                        <?php if ($i != 0): ?>
                            <div class="text-right">
                                <button type="button" class="cancel btn btn-blue">Отменить</button>
                            </div>
                        <?php endif; ?>
                    </div>
            <?php endfor; ?>
            </div>
        <div class="db text-center mtop-50">
            <button type="button" id="addlocation" class="btn btn-white-blue-border btn-add">Добавить локацию</button>
        </div>
        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>


</div>
