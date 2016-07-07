<? phpuse yii\helpers\Html;

?>
<div class="row">
    <a href="#" class="row-title">Выберите Заявочное изображение</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Загрузите своё изображение или выберите одно из предложенных:</div>
        </div>

        <div id="covers-wrap" class="db image-gallery mtop-10">
            <div class="required-field">
                <?= Html::activeHiddenInput($stockForm, 'picture') ?>
                <div class="drop-zone">
                    <label>
                        <?= Html::fileInput('CoverUploadForm[cover]', '', ['id' => 'add-image']) ?>
                    </label>
                </div>
                <div class="form-error-msg"></div>
            </div>
        </div>

        <div class="db mtop-10">
            <div class="text">Изображение не подходящее под <a href="#" target="_blank">гайдлайны</a> Покупона&Супердила, будет автоматически заменено
                случайной картинкой из нашей базы
            </div>
        </div>
        <div class="db mtop-40 text-right">
            <button class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>