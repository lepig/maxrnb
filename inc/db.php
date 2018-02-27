<?php
include 'vendor/autoload.php';
use Medoo\Medoo;

$dbconfig = [
    'database_type' => 'mysql',
    'database_name' => 'qdm165228672_db',
    'server' => 'qdm165228672.my3w.com',
    'username' => 'qdm165228672',
    'password' => 'lepigme1860',
    'charset' => 'utf8',

    // 可选参数
    'port' => 3306,
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];


$db = new medoo($dbconfig);
// return $db;