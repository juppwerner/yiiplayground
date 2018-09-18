<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.str_replace("\\", '/', __DIR__.'/../data/user.db'),
    'charset' => 'utf8',
];
