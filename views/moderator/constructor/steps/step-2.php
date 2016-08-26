<?php
    use yii\helpers\Html;
?>
<div class="row">
    <a href="#" class="row-title">Выберите картинку акции</a>
    <div class="row-content">
        <div class="db">
            <div class="text c-black">Загрузите своё изображение<span class="hidden default-images"> или выберите одно из предложенных</span>:
            </div>
        </div>

        <div id="covers-wrap" class="db image-gallery mtop-10">
            <div class="required-field">
                <?= Html::activeHiddenInput($stockForm, 'picture') ?>
                <div class="drop-zone">
                    <label>
                        <?= Html::fileInput('CoverUploadForm[cover]', '', ['id' => 'add-image']) ?>
                    </label>
                </div>
                <div class="form-error-msg f-14"></div>
            </div>
        </div>

        <div class="db mtop-10">
            <div class="text">Изображение не соответствующее
                <span class="dib"><span>требованиям</span>
                    <div class="helper ml-0">
                        <div class="helper-content-wrapper">
                            <div class="helper-content helper-right">
                                <p>
                                    Размер картинки: 720 х 340 пикселей,<br>
                                    Расширение: .jpg, .jpeg, .png<br>
                                    Общие требования: От качества и привлекательности картинки зависят продажи вашей акции. Постарайтесь подобрать изображение максимальное подходящее под описание вашей услуги
                                </p>
                            </div>
                        </div>
                    </div>
                </span>
                Покупона&Супердила, будет автоматически заменено случайной картинкой из нашей базы.
            </div>
        </div>
        <div class="db mtop-40 text-right">
            <button type="button" class="btn btn-yellow btn-next-step">Дальше</button>
        </div>
    </div>
</div>