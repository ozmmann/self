<?php

defined('YII_DEBUG') or define('YII_DEBUG', false);
require(__DIR__ . '/../helpers/DockerEnv.php');
\DockerEnv::init();
$config = \DockerEnv::webConfig();
(new yii\web\Application($config))->run();
