<? phpuse yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'Edit Stock';
    $this->registerJsFile('js/formStock.js', ['depends' => 'app\assets\AppAsset']);
    $this->registerCssFile('css/formStock.css', ['depends' => 'app\assets\AppAsset']);
    //    var_dump($conditionForm);
?>
<div class="row">
    <div class="col-sm-3 col-md-3 constructor">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="panel-group">
            <div class="panel panel-default active">
                <div class="panel-heading">1. ВЫБЕРИТЕ КАТЕГОРИЮ УСЛУГ</div>
                <div class="step-content open" id="step1">
                    <div class="panel-body">
                        <?= $form->field($stockForm, 'categoryId')
                                 ->label('Категория')
                                 ->dropDownList($categoryList, ['prompt' => '', 'data-placeholder' => 'Выберите категорию услуг']) ?>
                        <div class="form-group required">
                            <label for="discount" class="control-label">Введите размер скидки</label>
                            <div class="input-group col-lg-5">
                                <span class="input-group-addon discount-but" data-action="down"><span
                                        class="glyphicon glyphicon-minus"></span></span>
                                <?= Html::activeTextInput($stockForm, 'discount', [
                                    'class'       => 'form-control',
                                    'id'          => 'discount',
                                    'placeholder' => 0,
                                    'disabled'    => true
                                ]) ?>
                                <span class="input-group-addon discount-but" data-action="up"><span
                                        class="glyphicon glyphicon-plus"></span></span>
                            </div>
                        </div>
                        <span id="loading" class="hidden">Loading...</span>
                        <div class="form-group required" id="commissionTypeWrap">
                            <label for="commissionType" class="control-label">Введите тип размещения</label>
                            <?= Html::activeDropDownList($stockForm, 'commissionType', $commissionTypes, ['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success step-button pull-right" data-target="#step2"
                                data-action="next">Дальше <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">2. Oб акции</div>
                <div class="step-content" id="step2">
                    <div class="panel-body">
                        <?= $form->field($stockForm, 'title')
                                 ->label('Введите название акции')
                                 ->textarea() ?>
                        <?= $form->field($stockForm, 'price')
                                 ->label('Введите стоимость услуги')
                                 ->input('number') ?>
                        <?= $form->field($stockForm, 'startDate')
                                 ->label('Дата старта акции')
                                 ->input('date') ?>
                        <?= $form->field($stockForm, 'endDate')
                                 ->label('Дата окончания акции')
                                 ->input('date') ?>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info step-button" data-target="#step1" data-action="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                        </button>
                        <button type="button" class="btn btn-success step-button pull-right" data-target="#step3"
                                data-action="next">Дальше <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Изображения</div>
                <div class="step-content" id="step3">
                    <div class="panel-body">
                        <div id="covers-wrap">
                            <?php foreach($categoryCovers as $cover): ?>
                                <img src="<?= $cover ?>"
                                     class="img-thumbnail <?= ($cover == $stockForm->picture) ? 'selected' : '' ?>"
                                     style="width: 100px; height: 100px" onclick="selectCover(this)">
                            <?php endforeach; ?>
                        </div>

                        <?= Html::activeHiddenInput($stockForm, 'picture') ?>
                        <?= Html::fileInput('CoverUploadForm[cover]', '', ['class' => 'form-control', 'id' => 'add-image']) ?>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info step-button" data-target="#step2" data-action="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                        </button>
                        <button type="button" class="btn btn-success step-button pull-right" data-target="#step4"
                                data-action="next">Дальше <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Обязательные условия</div>
                <div class="step-content" id="step4">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="countPerson">1 купон распространяется на N человек
                            </label>
                        </div>
                        <div class="form-group" id="countPersonWrap">
                            <label class="control-label col-lg-5">Количество человек</label>
                            <div class="col-lg-4">
                                <?= Html::activeInput('number', $conditionForm, 'countPerson', ['class' => 'form-control', 'value' => 1]) ?>
                            </div>
                        </div>
                        <?= $form->field($conditionForm, 'preEntry')
                                 ->checkbox(['label' => 'Обязательная запись', 'labelOptions' => ['class' => 'checkbox-inline']]) ?>
                        <?= $form->field($conditionForm, 'discountSum')
                                 ->checkbox([
                                                'label'        => 'Скидка по купону не суммируется с другими предложениями заведения',
                                                'labelOptions' => ['class' => 'checkbox-inline']
                                            ]) ?>
                        <?= $form->field($conditionForm, 'preCall')
                                 ->checkbox([
                                                'label'        => 'Перед визитом, свяжитесь с администрацией',
                                                'labelOptions' => ['class' => 'checkbox-inline']
                                            ]) ?>
                        <?= $form->field($conditionForm, 'dispatcherCall')
                                 ->checkbox([
                                                'label'        => 'Для получения скидки, необходимо сообщить код диспетчеру',
                                                'labelOptions' => ['class' => 'checkbox-inline']
                                            ]) ?>
                        <?= $form->field($conditionForm, 'showCoupon')
                                 ->checkbox([
                                                'label'        => 'Предьявите сертификат в электронном или распечатанном виде',
                                                'labelOptions' => ['class' => 'checkbox-inline']
                                            ]) ?>
                        <?= $form->field($conditionForm, 'own')
                                 ->label('Свое условие')
                                 ->textarea() ?>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info step-button" data-target="#step3" data-action="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                        </button>
                        <button type="button" class="btn btn-success step-button pull-right" data-target="#step5"
                                data-action="next">Дальше <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Организатор</div>
                <div class="step-content" id="step5">
                    <div class="panel-body">
                        <?= $form->field($organizerForm, 'name')
                                 ->label('Организатор акции')
                                 ->textarea() ?>
                        <?= $form->field($organizerForm, 'phone')
                                 ->label('Телефон')
                                 ->input('tel') ?>
                        <?= $form->field($organizerForm, 'site')
                                 ->label('Сайт') ?>
                        <?= Html::activeHiddenInput($organizerForm, 'logo') ?>
                        <div class="form-group">
                            <label class="control-label" for="">Logo</label>
                            <div id="logo-wrap">
                                <?php if(!empty($organizerForm->logo)): ?>
                                    <img src="<?= $organizerForm->logo ?>" class="img-thumbnail"
                                         style="width: 100px; height: 100px;">
                                <?php endif; ?>
                            </div>
                            <?= Html::fileInput('LogoUploadForm[logo]', '', ['class' => 'form-control', 'id' => 'add-logo']) ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info step-button" data-target="#step4" data-action="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                        </button>
                        <button type="button" class="btn btn-success step-button pull-right" data-target="#step6"
                                data-action="next">Дальше <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Локация</div>
                <div class="step-content" id="step6">
                    <div class="panel-body">
                        <?= $form->field($locationForm, 'address')
                                 ->label('Адрес') ?>
                        <?= $form->field($locationForm, 'schedule')
                                 ->label('График работы') ?>
                        <?= $form->field($locationForm, 'site')
                                 ->label('Сайт')
                                 ->input('url') ?>
                        <?= $form->field($locationForm, 'phone')
                                 ->label('Телефон')
                                 ->input('tel') ?>
                        <?= $form->field($locationForm, 'note')
                                 ->label('Примечания')
                                 ->textarea(['placeholder' => 'Введите название организации']) ?>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-info step-button" data-target="#step5" data-action="prev">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                        </button>
                        <button type="submit" class="btn btn-success pull-right">
                            Сохранить <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-7 preview-wrap">
        <span class="preview-head">Предпросмотр акции</span>
        <div class="preview">
            <h1 id="stock-title">[НАЗВАНИЕ АКЦИИ]</h1>

            <div class="row">
                <div class="col-md-8">
                    <img id="stock-cover" src="/web/img/stock-prev.png">
                    <?php //todo описание акциий? ?>
                </div>
                <div class="col-md-4">
                    <div class="row prices">
                        <div class="col-md-12">
                            <span id="stock-price" class="full-price"></span>
                            <span class="price-with-discount"></span>
                            <span class="price-with-discount">грн.</span>
                        </div>
                    </div>
                    <button class="btn btn-primary buy"><strong>Купить</strong></button>
                    <div class="row info-header">
                        <div class="col-md-4">СКИДКА</div>
                        <div class="col-md-4">ЭКОНОМИЯ</div>
                        <div class="col-md-4">КУПИЛИ</div>
                    </div>
                    <div class="row info-body">
                        <div class="col-md-4"><span id="stock-discount">[-]</span><span>%</span></div>
                        <div class="col-md-4"><span id="stock-price">[-]</span><span>грн.</span></div>
                        <div class="col-md-4"><span id="stock-count">[-]</span><span>чел.</span></div>
                    </div>
                    <button class="btn btn-secondary favorites"><i class="fa fa-heart-o" aria-hidden="true"></i>
                        Добавить
                        в избранное
                    </button>
                </div>
                <div class="stock-date">
                    <span class="date-header">До конца акции</span>
                    <span class=""></span>
                </div>
                <!--                <p>Дата старта: <span id="stock-startdate"></span></p>-->
                <!--                <p>Дата окончания: <span id="stock-enddate"></span></p>-->
                <!--                <p>address: <span id="stock-address"></span></p>-->
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

</div>
</div>

