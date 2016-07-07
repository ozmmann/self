<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => \DockerEnv::dbDsn(),
    'username' => \DockerEnv::dbUser(),
    'password' => \DockerEnv::dbPassword(),
    'charset' => 'utf8',
    'tablePrefix' => 'ss_'
];
