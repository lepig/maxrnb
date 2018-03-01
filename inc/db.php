<?php

use Medoo\Medoo;

/*
$dbconfig = [
    'database_type' => 'mysql',
    'database_name' => 'ooxx',
    'server' => 'ooxx',
    'username' => 'ooxx',
    'password' => 'ooxx',
    'charset' => 'utf8',

    // 可选参数
    'port' => 3306,
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
*/

$dbconfig = parse_ini_file('config/mysql.ini');
$dbconfig['option'] = [
    PDO::ATTR_CASE => PDO::CASE_NATURAL
];


$db = new medoo($dbconfig);