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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/chosen.css',
        'css/magnific-popup.css',
        'css/style.css'
    ];
    public $js = [
        'js/chosen.jquery.min.js',
        'js/hammer.min.js',
        'js/main.js',
        'js/jquery.magnific-popup.min.js',
        'js/jquery.mask.min.js',
        'js/slick.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
