<?php

//const ROOT_DIR = 'C:\www\Credissimo\mvc';
//const TEMPLATES_DIR = ROOT_DIR . '\src\Views\Templates\\';

//$db_config ['host'] =   $_ENV['A']     ?? $LocalConfig['MYSQL_HOST'];


const APPLICATION_HOST = 'http://localhost:8888';

$LocalConfig = [
    'MYSQL_HOST' =>   'localhost',
    'MYSQL_PORT' =>   '3333',
    'MYSQL_DATABASE' =>      'mvc_db',
    'MYSQL_USER' =>   'mvc_user',
    'MYSQL_PASSWORD' =>   'mvc_password',
    'MYSQL_CHARSET' =>'utf8mb4',
  ];


$db_config ['host'] =   $_ENV['MYSQL_HOST']     ?? $LocalConfig['MYSQL_HOST'];
$db_config['port']  =   $_ENV['MYSQL_PORT']     ?? $LocalConfig['MYSQL_PORT'];
$db_config['db']    =   $_ENV['MYSQL_DATABASE'] ?? $LocalConfig['MYSQL_DATABASE'] ;
$db_config['user']  =   $_ENV['MYSQL_USER']     ?? $LocalConfig['MYSQL_USER'] ;
$db_config['pass']  =   $_ENV['MYSQL_PASSWORD'] ?? $LocalConfig['MYSQL_PASSWORD'];
$db_config['charset']=  $_ENV['MYSQL_CHARSET']  ?? $LocalConfig['MYSQL_CHARSET'];


$_ENV['REDIS_HOST'] = $_ENV['REDIS_HOST'] ?? 'localhost';
$_ENV['REDIS_PORT'] = $_ENV['REDIS_PORT'] ?? '6379';

define("DB_CONNECTION", $db_config);


const ROOT_DIR = __DIR__ . '/../';
const TEMPLATES_DIR = ROOT_DIR . '/src/Views/Templates/';

const views = [
    'user.index' => TEMPLATES_DIR . 'user.index.php',
    'user.details' => TEMPLATES_DIR . 'user.details.php',
    'user.create' => TEMPLATES_DIR . 'user.create.php',
    'user.edit' => TEMPLATES_DIR . 'user.edit.php',
    'user.delete' => TEMPLATES_DIR . 'user.delete.php',

];


