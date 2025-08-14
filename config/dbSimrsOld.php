<?php

return [
  'class' => 'yii\db\Connection',
  'dsn' =>  $config_apps['config']['db']['sql_server']['db_sql_server'],
  'username' =>  $config_apps['config']['db']['sql_server']['user_sql_server'],
  'password' =>  $config_apps['config']['db']['sql_server']['pass_sql_server'],
  'charset' => 'utf8',
  'tablePrefix' => 'dbo.',
];