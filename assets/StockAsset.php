<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class StockAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/pickdate/classic.css',
        'css/nouislider.min.css',
        'css/pickdate/classic.date.css',
    ];
    public $js = [
        'js/pickdate/picker.js',
        'js/pickdate/picker.date.js',
        'js/nouislider.min.js',
        'js/wNumb.js',
        'js/formStock.js',
        'js/map.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
