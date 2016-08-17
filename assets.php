<?php
/**
 * Configuration file for the "yii asset" console command.
 */

 Yii::setAlias('@webroot', __DIR__ . '/web');
 Yii::setAlias('@web', '/');

return [
    'jsCompressor' => 'java -jar compiler.jar --js {from} --js_output_file {to} --jscomp_off=uselessCode --warning_level=QUIET',
    'cssCompressor' => 'java -jar yuicompressor.jar --type css {from} -o {to}',
    'bundles' => [
        'app\assets\ModeratorAsset',
        'app\assets\StockAsset',
        'app\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ],
    'targets' => [
        'allShared' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
            'depends' => [
                'app\assets\AppAsset',
                'yii\web\YiiAsset',
                'yii\web\JqueryAsset',
            ],
        ],
        'stock' => [
            'class' => 'yii\web\AssetBundle',
            'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'depends' => [
                'app\assets\StockAsset',
            ],
        ],
        'moderator' => [
            'class' => 'yii\web\AssetBundle',
            'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'depends' => [
                'app\assets\ModeratorAsset',
            ],
        ],
    ],
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
    ],
];